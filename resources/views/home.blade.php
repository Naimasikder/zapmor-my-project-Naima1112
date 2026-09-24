<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Zapmor - Book Your Appointment</title>

    @vite(['resources/css/app.css'])
</head>

<body>

    <!-- ================= NAVBAR ================= -->

    <header class="navbar">

        <div class="nav-container">

            <!-- Logo -->
            <a href="#" class="logo">
                Zapmor
            </a>

            <!-- Navigation -->
            <nav class="nav-menu">

                <a href="{{ route('home') }}">Home</a>

                <a href="#" class="services-link">
                    Services
                    <span class="arrow">⌄</span>
                </a>

                <a href="{{ route('book.now') }}">Book Now</a>

                <a href="#">About</a>

                <a href="#">Contact</a>

                <a href="#" class="login-btn">
                    Login
                </a>

                <a href="#" class="app-btn">
                    <span class="play-icon">▶</span>
                    Get App
                </a>

            </nav>

        </div>

    </header>


    <!-- ================= HERO SECTION ================= -->

    <main class="hero">

        <div class="hero-container">

            <!-- LEFT CONTENT -->

            <div class="hero-content">

                <div class="small-badge">
                    <span>⚡</span>
                    APPOINTMENTS IN SECONDS
                </div>


                <h1>
                    Doctors and<br>
                    beauty pros,<br>

                    <span class="gradient-text">
                        booked in one tap.
                    </span>
                </h1>


                <p class="hero-description">

                    Zapmor puts trusted physicians and beauty
                    specialists on your phone — real-time slots,
                    verified providers, and instant confirmations,
                    every time.

                </p>


                <!-- BUTTONS -->

                <div class="hero-buttons">

                    <a href="#" class="download-btn">
                        <span class="play-icon">▶</span>
                        Download for Android
                    </a>

                    <a href="{{ route('book.now') }}" class="booking-btn">
                        Book an appointment
                    </a>

                </div>


                <!-- STATS -->

                <div class="stats">

                    <div class="stat">

                        <h3>12k+</h3>

                        <p>
                            Appointments booked
                        </p>

                    </div>


                    <div class="stat">

                        <h3>480+</h3>

                        <p>
                            Verified providers
                        </p>

                    </div>


                    <div class="stat">

                        <h3>4.8<span>★</span></h3>

                        <p>
                            Average rating
                        </p>

                    </div>

                </div>

            </div>


            <!-- RIGHT SIDE -->

            <div class="hero-visual">


                <!-- DOCTOR CARD -->

                <div class="doctor-card">

                    <div class="doctor-header">

                        <div class="doctor-avatar">
                            DR
                        </div>

                        <div class="doctor-info">

                            <h3>
                                Dr. Alia<br>
                                Rahman
                            </h3>

                            <p>
                                General<br>
                                Physician
                            </p>

                        </div>

                        <span class="available">
                            Available
                        </span>

                    </div>


                    <div class="time-slots">

                        <div class="time-slot">

                            <span>
                                Today, 4:30 PM
                            </span>

                            <span class="clock">
                                ◷
                            </span>

                        </div>


                        <div class="time-slot">

                            <span>
                                Today, 5:15 PM
                            </span>

                            <span class="clock">
                                ◷
                            </span>

                        </div>


                        <div class="time-slot">

                            <span>
                                Tomorrow, 10:00 AM
                            </span>

                            <span class="clock">
                                ◷
                            </span>

                        </div>

                    </div>

                </div>


                <!-- FACIAL CARD -->

                <div class="floating-card facial-card">

                    <div class="service-icon pink">
                        ♨
                    </div>

                    <div>

                        <h4>
                            Facial & Spa
                        </h4>

                        <p>
                            Booked · Confirmed
                        </p>

                    </div>

                </div>


                <!-- DENTAL CARD -->

                <div class="floating-card dental-card">

                    <div class="service-icon blue">
                        ♣
                    </div>

                    <div>

                        <h4>
                            Dental Cleaning
                        </h4>

                        <p>
                            Slot secured for Sat
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </main>

</body>
</html>