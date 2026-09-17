<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Zapmor - Book Appointment</title>

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

        .navbar {
            height: 90px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 12%;
            border-bottom: 1px solid #eeeeee;
        }

        .logo {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(90deg, #286eff, #c127e8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: #596179;
            font-size: 16px;
            font-weight: 600;
        }

        .login-btn {
            border: 1.5px solid #2875ff;
            padding: 10px 20px;
            border-radius: 30px;
            color: #1768dc !important;
        }

        .app-btn {
            background: linear-gradient(90deg, #2277ff, #c125e8);
            color: white !important;
            padding: 12px 21px;
            border-radius: 30px;
        }

        .booking-section {
            min-height: calc(100vh - 90px);
            padding: 35px 20px 60px;
            text-align: center;
            background: #f5f6ff;
        }

        .subtitle {
            color: #c126e8;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        h1 {
            font-size: 42px;
            color: #101b3c;
            margin-bottom: 45px;
        }

        .booking-card {
            width: 780px;
            max-width: 95%;
            margin: auto;
            background: white;
            padding: 45px;
            border-radius: 28px;
            text-align: left;
            box-shadow: 0 15px 45px rgba(42, 57, 120, 0.10);
        }

        /* SUCCESS MESSAGE */

        .success-message {
            background: #d1fae5;
            color: #065f46;
            padding: 15px 18px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-weight: 600;
            border: 1px solid #a7f3d0;
        }

        /* ERROR MESSAGE */

        .error-message {
            background: #fee2e2;
            color: #991b1b;
            padding: 15px 18px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-weight: 600;
            border: 1px solid #fecaca;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .form-group {
            width: 100%;
        }

        label {
            display: block;
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        label span {
            color: #111;
        }

        input,
        select,
        textarea {
            width: 100%;
            border: 1px solid #dfe4ef;
            border-radius: 12px;
            padding: 13px 14px;
            font-size: 15px;
            outline: none;
            background: white;
        }

        input,
        select {
            height: 48px;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #4285ff;
        }

        small {
            display: block;
            margin-top: 8px;
            color: #667085;
            font-size: 13px;
        }

        select:disabled {
            background: #e9edf3;
            color: #4d5566;
            cursor: not-allowed;
        }

        .notes {
            margin-top: 25px;
        }

        textarea {
            min-height: 95px;
            resize: vertical;
        }

        .confirm-btn {
            width: 100%;
            height: 52px;
            margin-top: 25px;
            border: none;
            border-radius: 13px;
            background: linear-gradient(90deg, #1677ff, #c126e8);
            color: white;
            font-size: 17px;
            font-weight: 700;
            cursor: pointer;
        }

        .confirm-btn:hover {
            opacity: 0.95;
        }

        @media (max-width: 700px) {

            .navbar {
                height: auto;
                padding: 20px;
                flex-direction: column;
                gap: 20px;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .booking-card {
                padding: 25px 20px;
            }

            h1 {
                font-size: 32px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">

    <div class="logo">
        Zapmor
    </div>

    <div class="nav-links">

        <a href="#">
            Home
        </a>

        <a href="#">
            Services ▼
        </a>

        <a href="/book-now">
            Book Now
        </a>

        <a href="#">
            About
        </a>

        <a href="#">
            Contact
        </a>

        <a href="#" class="login-btn">
            Login
        </a>

        <a href="#" class="app-btn">
            ▶ Get App
        </a>

    </div>

</nav>


<section class="booking-section">

    <div class="subtitle">
        RESERVE YOUR SLOT
    </div>

    <h1>
        Book your appointment
    </h1>


    <div class="booking-card">

        {{-- SUCCESS MESSAGE --}}

        @if(session('success'))

            <div class="success-message">
                {{ session('success') }}
            </div>

        @endif


        {{-- ERROR MESSAGE --}}

        @if($errors->any())

            <div class="error-message">
                {{ $errors->first() }}
            </div>

        @endif


        <form
            action="{{ url('/appointments') }}"
            method="POST"
            id="bookingForm"
        >

            @csrf


            <div class="form-grid">

                {{-- FULL NAME --}}

                <div class="form-group">

                    <label>
                        Full Name <span>*</span>
                    </label>

                    <input
                        type="text"
                        name="full_name"
                        value="{{ old('full_name', auth()->user()->name ?? '') }}"
                        placeholder="Enter your full name"
                        required
                    >

                    <small>
                        Enter your full name.
                    </small>

                </div>


                {{-- EMAIL --}}

                <div class="form-group">

                    <label>
                        Email <span>*</span>
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', auth()->user()->email ?? '') }}"
                        placeholder="Enter your email"
                        required
                    >

                </div>


                {{-- SERVICE TYPE --}}

                <div class="form-group">

                    <label>
                        Service Type <span>*</span>
                    </label>

                    <select
                        id="serviceType"
                        required
                    >

                        <option value="">
                            Select...
                        </option>

                        <option value="doctor">
                            Doctor
                        </option>

                        <option value="parlor">
                            Parlor
                        </option>

                    </select>

                </div>


                {{-- SPECIFIC SERVICE --}}

                <div class="form-group">

                    <label>
                        Specific Service <span>*</span>
                    </label>

                    <select
                        name="specific_service"
                        id="specificService"
                        disabled
                        required
                    >

                        <option value="">
                            Choose service type first
                        </option>

                    </select>

                </div>


                {{-- PREFERRED DOCTOR --}}

                <div class="form-group">

                    <label>
                        Preferred Doctor
                    </label>

                    <select
                        name="provider_id"
                        id="doctor"
                        required
                    >

                        <option value="">
                            Select Doctor
                        </option>

                        @foreach(
                            \App\Models\Provider::where('status', 1)
                                ->orderBy('id')
                                ->get()
                            as $doctor
                        )

                            <option
                                value="{{ $doctor->id }}"
                                {{ old('provider_id') == $doctor->id ? 'selected' : '' }}
                            >
                                {{ $doctor->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- DATE & TIME --}}

                <div class="form-group">

                    <label>
                        Date & Time <span>*</span>
                    </label>

                    <input
                        type="datetime-local"
                        id="appointmentDateTime"
                        required
                    >

                    <input
                        type="hidden"
                        name="appointment_date"
                        id="appointment_date"
                    >

                    <input
                        type="hidden"
                        name="appointment_time"
                        id="appointment_time"
                    >

                </div>

            </div>


            {{-- NOTES --}}

            <div class="form-group notes">

                <label>
                    Additional Notes
                </label>

                <textarea
                    name="notes"
                    placeholder="Write any additional information..."
                >{{ old('notes') }}</textarea>

            </div>


            {{-- CONFIRM BUTTON --}}

            <button
                type="submit"
                class="confirm-btn"
            >
                Confirm Booking
            </button>

        </form>

    </div>

</section>


<script>

    const serviceType =
        document.getElementById('serviceType');

    const specificService =
        document.getElementById('specificService');


    serviceType.addEventListener('change', function () {

        specificService.innerHTML = '';


        if (this.value === '') {

            specificService.disabled = true;

            specificService.innerHTML =
                '<option value="">Choose service type first</option>';

            return;
        }


        specificService.disabled = false;


        let services = [];


        /* DOCTOR SERVICES */

        if (this.value === 'doctor') {

            services = [
                'General Physician',
                'Dentist',
                'Cardiologist',
                'Dermatologist'
            ];

        }


        /* PARLOR SERVICES */

        if (this.value === 'parlor') {

            services = [
                'Hair Cut',
                'Hair Styling',
                'Facial',
                'Makeup',
                'Manicure',
                'Pedicure'
            ];

        }


        services.forEach(function(service) {

            const option =
                document.createElement('option');

            option.value = service;

            option.textContent = service;

            specificService.appendChild(option);

        });

    });


    /* DATE & TIME */

    const bookingForm =
        document.getElementById('bookingForm');

    const appointmentDateTime =
        document.getElementById('appointmentDateTime');

    const appointmentDate =
        document.getElementById('appointment_date');

    const appointmentTime =
        document.getElementById('appointment_time');


    bookingForm.addEventListener('submit', function () {

        if (!appointmentDateTime.value) {
            return;
        }


        const parts =
            appointmentDateTime.value.split('T');


        /*
         * Date:
         * 2026-09-20
         */

        appointmentDate.value =
            parts[0];


        /*
         * Time:
         * 10:00
         *
         * IMPORTANT:
         * Do NOT add :00 here.
         * Controller expects H:i.
         */

        appointmentTime.value =
            parts[1];

    });

</script>

</body>
</html>