<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Management - Zapmor</title>

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
            font-size: 22px;
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
            min-width: 1000px;
        }

        th {
            background: #f5f6ff;
            color: #101b3c;
            text-align: left;
            padding: 16px;
            font-size: 19px;
            font-weight: 700;
            white-space: nowrap;
        }

        td {
            padding: 19px;
            border-bottom: 1px solid #eee;
            font-size: 17px;
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

        .delete-btn {
            padding: 9px 15px;
            border: none;
            border-radius: 8px;
            background: #dc2626;
            color: white;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .delete-btn:hover {
            opacity: .9;
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

    <h1>Parlor Appointment Management</h1>

    <p class="subtitle">
        Manage all customer appointments
    </p>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search -->
    <div class="filters">
        <input
            type="text"
            id="searchInput"
            placeholder="Search customer name or email..."
        >
    </div>

    <div class="table-card">

        @if($appointments->count() > 0)

            <table>

                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Parlor</th>
                        <th>Service</th>
                        <th>Date & Time</th>
                        <th>Details</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($appointments as $appointment)

                        <tr>

                            <td>
                                <div class="customer-name">
                                    {{ $appointment->customer_name }}
                                </div>
                            </td>

                            <td>
                                <div class="customer-email">
                                    {{ $appointment->email }}
                                </div>
                            </td>

                            <td>
                                {{ $appointment->parlor?->name ?? 'Any Available' }}
                            </td>

                            <td>
                                {{ $appointment->service?->service_name ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $appointment->appointment_datetime->format('d M Y, h:i A') }}
                            </td>

                            <!-- View -->
                            <td>

                                <button
                                    type="button"
                                    class="details-btn"
                                    onclick="showAppointmentDetails(
                                        '{{ addslashes($appointment->customer_name) }}',
                                        '{{ addslashes($appointment->email) }}',
                                        '{{ addslashes($appointment->parlor?->name ?? 'Any Available') }}',
                                        '{{ addslashes($appointment->service?->service_name ?? 'N/A') }}',
                                        '{{ $appointment->appointment_datetime->format('d M Y, h:i A') }}',
                                        '{{ addslashes($appointment->note ?? 'No note') }}'
                                    )"
                                >
                                    View
                                </button>

                            </td>

                            <!-- Delete -->
                            <td>

                                <form
                                    method="POST"
                                    action="{{ route('appointments.destroy', $appointment->appointment_id) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this appointment?');"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="delete-btn"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <div class="no-data">
                No appointments found.
            </div>

        @endif

    </div>

</div>


<script>

    // Search customer
    const searchInput = document.getElementById('searchInput');

    function filterAppointments() {

        const searchValue =
            searchInput.value.toLowerCase().trim();

        const rows =
            document.querySelectorAll('tbody tr');

        rows.forEach(row => {

            const customer =
                row.cells[0].innerText.toLowerCase().trim();

            const email =
                row.cells[1].innerText.toLowerCase().trim();

            const matchesSearch =
                customer.includes(searchValue) ||
                email.includes(searchValue);

            row.style.display =
                matchesSearch ? '' : 'none';

        });

    }

    searchInput.addEventListener(
        'input',
        filterAppointments
    );


    // Appointment details
    function showAppointmentDetails(
        customer,
        email,
        parlor,
        service,
        dateTime,
        note
    ) {

        alert(
            'Customer: ' + customer +
            '\nEmail: ' + email +
            '\nParlor: ' + parlor +
            '\nService: ' + service +
            '\nDate & Time: ' + dateTime +
            '\nNote: ' + note
        );

    }

</script>

</body>

</html>