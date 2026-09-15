<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'provider_id' => 'required|exists:providers,id',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date',
            'appointment_time' => [
                'required',
                'date_format:H:i',
                Rule::unique('appointments', 'appointment_time')
                    ->where(function ($query) use ($request) {
                        return $query
                            ->where('provider_id', $request->provider_id)
                            ->where('appointment_date', $request->appointment_date)
                            ->where('status', '!=', 'cancelled');
                    }),
            ],
            'notes' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();

        $appointment = Appointment::create($validated);

        return response()->json([
            'message' => 'Appointment booked successfully',
            'appointment' => $appointment,
        ], 201);
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
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