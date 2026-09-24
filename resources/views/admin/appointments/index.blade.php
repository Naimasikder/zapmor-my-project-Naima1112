<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Appointments - Zapmor</title>

    @vite(['resources/css/app.css'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        .admin-container {
            width: 95%;
            max-width: 1400px;
            margin: 40px auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-header h1 {
            margin: 0;
            font-size: 30px;
            color: #111827;
        }

        .page-header p {
            margin-top: 7px;
            color: #6b7280;
        }

        .total-box {
            background: #ffffff;
            padding: 14px 22px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
            font-weight: 600;
        }

        .success-message {
            background: #dcfce7;
            color: #166534;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #bbf7d0;
        }

        .table-card {
            background: #ffffff;
            border-radius: 16px;
            overflow-x: auto;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1050px;
        }

        thead {
            background: #111827;
            color: #ffffff;
        }

        th {
            padding: 17px 15px;
            text-align: left;
            font-size: 16px;
            font-weight: 600;
            white-space: nowrap;
        }

        td {
            padding: 17px 15px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 15px;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #f9fafb;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .patient-name {
            font-weight: 600;
            font-size: 16px;
            color: #111827;
        }

        .email {
            color: #6b7280;
            font-size: 15px;
            margin-top: 4px;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 13px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .status-pending {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-confirmed {
            background: #dcfce7;
            color: #15803d;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #dc2626;
        }

        .status-completed {
            background: #ede9fe;
            color: #7c3aed;
        }

        .status-form {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .status-select {
            padding: 10px 11px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: #ffffff;
            font-size: 14px;
            cursor: pointer;
            outline: none;
        }

        .status-select:focus {
            border-color: #2563eb;
        }

        .update-btn {
            border: none;
            background: #16a34a;
            color: #ffffff;
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .update-btn:hover {
            background: #15803d;
        }

        .empty-message {
            text-align: center;
            padding: 50px;
            color: #6b7280;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #2563eb;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .admin-container {
                width: 92%;
                margin: 25px auto;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .page-header h1 {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>

    <div class="admin-container">

        <a href="{{ route('home') }}" class="back-link">
            ← Back to Home
        </a>

        <div class="page-header">

            <div>
                <h1>Admin Appointments</h1>
                <p>Manage all patient appointments and update their status.</p>
            </div>

            <div class="total-box">
                Total: {{ $appointments->count() }}
            </div>

        </div>

        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-card">

            @if ($appointments->count() > 0)

                <table>

                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Email</th>
                            <th>Doctor</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Update</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($appointments as $appointment)

                            <tr>

                                <td>
                                    <div class="patient-name">
                                        {{ $appointment->user?->name ?? 'N/A' }}
                                    </div>
                                </td>

                                <td>
                                    <div class="email">
                                        {{ $appointment->user?->email ?? 'N/A' }}
                                    </div>
                                </td>

                                <td>
                                    {{ $appointment->provider?->name ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $appointment->service?->name ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $appointment->appointment_date?->format('d M Y') }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                </td>

                                <td>

                                    @if ($appointment->status === 'pending')

                                        <span class="status-badge status-pending">
                                            Pending
                                        </span>

                                    @elseif ($appointment->status === 'confirmed')

                                        <span class="status-badge status-confirmed">
                                            Confirmed
                                        </span>

                                    @elseif ($appointment->status === 'cancelled')

                                        <span class="status-badge status-cancelled">
                                            Cancelled
                                        </span>

                                    @elseif ($appointment->status === 'completed')

                                        <span class="status-badge status-completed">
                                            Completed
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <form
                                        method="POST"
                                        action="{{ route('admin.appointments.updateStatus', $appointment) }}"
                                        class="status-form"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <select
                                            name="status"
                                            class="status-select"
                                        >
                                            <option
                                                value="pending"
                                                {{ $appointment->status === 'pending' ? 'selected' : '' }}
                                            >
                                                Pending
                                            </option>

                                            <option
                                                value="confirmed"
                                                {{ $appointment->status === 'confirmed' ? 'selected' : '' }}
                                            >
                                                Confirmed
                                            </option>

                                            <option
                                                value="cancelled"
                                                {{ $appointment->status === 'cancelled' ? 'selected' : '' }}
                                            >
                                                Cancelled
                                            </option>

                                            <option
                                                value="completed"
                                                {{ $appointment->status === 'completed' ? 'selected' : '' }}
                                            >
                                                Completed
                                            </option>
                                        </select>

                                        <button
                                            type="submit"
                                            class="update-btn"
                                        >
                                            Update
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @else

                <div class="empty-message">
                    No appointments found.
                </div>

            @endif

        </div>

    </div>

</body>
</html>
