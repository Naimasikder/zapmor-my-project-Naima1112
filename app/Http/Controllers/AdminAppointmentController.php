<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminAppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with([
            'user',
            'provider',
            'service',
        ])
            ->latest()
            ->get();

        return view(
            'admin.appointments.index',
            compact('appointments')
        );
    }

    public function updateStatus(
        Request $request,
        Appointment $appointment
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,confirmed,cancelled,completed',
            ],
        ]);

        $appointment->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.appointments.index')
            ->with(
                'success',
                'Appointment status updated successfully!'
            );
    }
}