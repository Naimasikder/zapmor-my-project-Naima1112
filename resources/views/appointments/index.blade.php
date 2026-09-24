<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Appointments - Zapmor</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f6ff;
            color: #10182f;
        }

        .container {
            width: 95%;
            max-width: 1450px;
            margin: 50px auto;
        }

        h1 {
            font-size: 40px;
            font-weight: 800;
            margin-bottom: 10px;
            color: #101b3c;
        }

        .subtitle {
            color: #0b1325;
            margin-bottom: 30px;
            font-size: 20px;
        }

        .success-message {
            background: #d1fae5;
            color: #065f46;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 16px;
            font-weight: 600;
        }

        .error-message {
            background: #fee2e2;
            color: #991b1b;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 16px;
            font-weight: 600;
        }

        .filters {
            margin-bottom: 20px;
        }

        .filters input {
            padding: 15px 17px;
            border: 1px solid #dfe4ef;
            border-radius: 10px;
            font-size: 17px;
            background: white;
            outline: none;
            width: 350px;
        }

        .filters input:focus {
            border-color: #4285ff;
        }

        .table-card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 15px 45px rgba(42, 57, 120, .10);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1050px;
        }

        th {
            background: #f5f6ff;
            color: #101b3c;
            text-align: left;
            padding: 16px;
            font-size: 17px;
            font-weight: 700;
            white-space: nowrap;
        }

        td {
            padding: 18px 16px;
            border-bottom: 1px solid #eee;
            font-size: 16px;
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .customer-name {
            font-weight: 800;
            color: #10182f;
        }

        .customer-email {
            color: #667085;
            margin-top: 5px;
        }

        .doctor-name {
            font-weight: 700;
            color: #10182f;
        }

        .service-name {
            color: #475467;
        }

        .date-time {
            white-space: nowrap;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-confirmed {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-completed {
            background: #d1fae5;
            color: #065f46;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .details-btn {
            padding: 9px 15px;
            border: none;
            border-radius: 8px;
            background: #101b3c;
            color: white;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .details-btn:hover {
            opacity: .9;
        }

        .cancel-btn {
            padding: 9px 15px;
            border: none;
            border-radius: 8px;
            background: #dc2626;
            color: white;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .cancel-btn:hover {
            opacity: .9;
        }

        .cancelled-text {
            color: #991b1b;
            font-weight: 600;
        }

        .no-data {
            text-align: center;
            padding: 50px;
            color: #667085;
            font-size: 17px;
        }

        @media (max-width: 800px) {
            .container {
                width: 94%;
                margin: 30px auto;
            }

            h1 {
                font-size: 28px;
            }

            .subtitle {
                font-size: 15px;
            }

            .filters input {
                width: 100%;
            }

            .table-card {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <h1>My Appointments</h1>

    <p class="subtitle">
        View and manage your appointments
    </p>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="error-message">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error-message">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="filters">
        <input
            type="text"
            id="searchInput"
            placeholder="Search doctor or service..."
        >
    </div>

    <div class="table-card">

        @if($appointments->count() > 0)

            <table>

                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Service</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Details</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($appointments as $appointment)

                    <tr>

                        <td>
                            <div class="doctor-name">
                                {{ $appointment->provider?->name ?? 'N/A' }}
                            </div>
                        </td>

                        <td>
                            <div class="service-name">
                                {{ $appointment->service?->name ?? 'N/A' }}
                            </div>
                        </td>

                        <td>
                            {{ $appointment->appointment_date?->format('d M Y') }}
                        </td>

                        <td class="date-time">
                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                        </td>

                        <td>
                            <span class="status status-{{ $appointment->status }}">
                                {{ $appointment->status }}
                            </span>
                        </td>

                        <td>

                            <button
                                type="button"
                                class="details-btn"
                                onclick="showAppointmentDetails(
                                    '{{ addslashes($appointment->provider?->name ?? 'N/A') }}',
                                    '{{ addslashes($appointment->service?->name ?? 'N/A') }}',
                                    '{{ $appointment->appointment_date?->format('d M Y') }}',
                                    '{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}',
                                    '{{ addslashes($appointment->notes ?? 'No note') }}',
                                    '{{ addslashes($appointment->status) }}'
                                )"
                            >
                                View
                            </button>

                        </td>

                        <td>

                            @if($appointment->status !== 'cancelled')

                                <form
                                    method="POST"
                                    action="{{ route('appointments.updateStatus', $appointment) }}"
                                    onsubmit="return confirm('Are you sure you want to cancel this appointment?');"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <input
                                        type="hidden"
                                        name="status"
                                        value="cancelled"
                                    >

                                    <button
                                        type="submit"
                                        class="cancel-btn"
                                    >
                                        Cancel
                                    </button>

                                </form>

                            @else

                                <span class="cancelled-text">
                                    Cancelled
                                </span>

                            @endif

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        @else

            <div class="no-data">
                You have no appointments yet.
            </div>

        @endif

    </div>

</div>


<script>

    const searchInput = document.getElementById('searchInput');

    function filterAppointments() {

        const searchValue =
            searchInput.value.toLowerCase().trim();

        const rows =
            document.querySelectorAll('tbody tr');

        rows.forEach(row => {

            const doctor =
                row.cells[0].innerText.toLowerCase();

            const service =
                row.cells[1].innerText.toLowerCase();

            const matchesSearch =
                doctor.includes(searchValue) ||
                service.includes(searchValue);

            row.style.display =
                matchesSearch ? '' : 'none';

        });
    }

    searchInput.addEventListener(
        'input',
        filterAppointments
    );


    function showAppointmentDetails(
        doctor,
        service,
        date,
        time,
        notes,
        status
    ) {

        alert(
            'Doctor: ' + doctor +
            '\nService: ' + service +
            '\nDate: ' + date +
            '\nTime: ' + time +
            '\nStatus: ' + status +
            '\nNotes: ' + notes
        );

    }

</script>

</body>

</html>