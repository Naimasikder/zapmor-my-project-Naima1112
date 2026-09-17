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
        $user = Auth::user();

        $validated = $request->validate([
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

            'notes' => 'nullable|string',
        ]);

        // Find selected service from database
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

        // Create appointment
        Appointment::create([
            'user_id' => $user->id,
            'provider_id' => $validated['provider_id'],
            'service_id' => $service->id,
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        // Redirect back to Book Now page with success message
        return redirect()
            ->route('book.now')
            ->with(
                'success',
                'Your appointment has been booked successfully!'
            );
    }

    /**
     * Update appointment status.
     */
    public function updateStatus(
        Request $request,
        Appointment $appointment
    ) {
        $validated = $request->validate([
            'status' =>
                'required|in:pending,confirmed,completed,cancelled',
        ]);

        $appointment->update([
            'status' => $validated['status'],
        ]);

        return response()->json([
            'message' => 'Appointment status updated successfully',
            'appointment' => $appointment,
        ]);
    }
}