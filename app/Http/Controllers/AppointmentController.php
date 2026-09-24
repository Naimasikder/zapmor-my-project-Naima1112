<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Provider;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    /**
     * Display the logged-in user's appointments.
     */
    public function index()
    {
        $appointments = Appointment::with(['provider', 'service'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Get all available doctors.
     */
    public function doctors()
    {
        $doctors = Provider::where('status', 1)
            ->select('id', 'name', 'specialization', 'phone', 'email')
            ->orderBy('id')
            ->get();

        return response()->json([
            'doctors' => $doctors,
        ]);
    }

    /**
     * Book an appointment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'provider_id' => [
                'required',
                'exists:providers,id',
            ],

            'specific_service' => [
                'required',
                'in:General Physician,Dentist,Cardiologist,Dermatologist',
            ],

            'appointment_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'appointment_time' => [
                'required',
                'date_format:H:i',

                Rule::unique('appointments', 'appointment_time')
                    ->where(function ($query) use ($request) {
                        return $query
                            ->where('provider_id', $request->provider_id)
                            ->where(
                                'appointment_date',
                                $request->appointment_date
                            )
                            ->where('status', '!=', 'cancelled');
                    }),
            ],

            'notes' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $user = Auth::user();

        /*
         * The booking email must match
         * the logged-in user's account.
         */
        if ($user->email !== $validated['email']) {
            return back()
                ->withErrors([
                    'email' =>
                        'The email must match your logged-in account.',
                ])
                ->withInput();
        }

        /*
         * Keep the logged-in user's name updated.
         */
        if ($user->name !== $validated['full_name']) {
            $user->name = $validated['full_name'];
            $user->save();
        }

        /*
         * Find selected active service.
         */
        $service = Service::where('name', $validated['specific_service'])
            ->where('status', 1)
            ->first();

        if (!$service) {
            return redirect()
                ->route('book.now')
                ->withErrors([
                    'specific_service' =>
                        'Selected service is not available.',
                ])
                ->withInput();
        }

        /*
         * Find selected active doctor.
         */
        $provider = Provider::where('id', $validated['provider_id'])
            ->where('status', 1)
            ->first();

        if (!$provider) {
            return redirect()
                ->route('book.now')
                ->withErrors([
                    'provider_id' =>
                        'Selected doctor is not available.',
                ])
                ->withInput();
        }

        /*
         * Create appointment.
         */
        Appointment::create([
            'user_id' => $user->id,
            'provider_id' => $provider->id,
            'service_id' => $service->id,
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('book.now')
            ->with(
                'success',
                'Your appointment has been booked successfully!'
            );
    }

    /**
     * Cancel an appointment.
     */
    public function updateStatus(
        Request $request,
        Appointment $appointment
    ) {
        /*
         * Users can only modify their own appointment.
         */
        if ($appointment->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => [
                'required',
                'in:cancelled',
            ],
        ]);

        $appointment->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('appointments.index')
            ->with(
                'success',
                'Appointment cancelled successfully!'
            );
    }
}