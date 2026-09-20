<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Zapmor - Contact Us</title>

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

        .contact-section {
            min-height: 100vh;
            padding: 55px 20px 70px;
            background: #f5f6ff;
        }

        .heading {
            text-align: center;
            margin-bottom: 52px;
        }

        .subtitle {
            color: #c126e8;
            font-size: 23px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        .heading h1 {
            font-size: 52px;
            color: #101b3c;
            font-weight: 800;
        }

        .contact-container {
            width: 1600px;
            max-width: 120%;
            margin: auto;

            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 35px;
        }

        .contact-card {
            background: white;
            border-radius: 30px;
            padding: 66px 65px;
            min-height: 500px;

            box-shadow:
                0 15px 45px rgba(42, 57, 120, 0.10);
        }

        .form-group {
            margin-bottom: 28px;
        }

        .form-group label {
            display: block;
            font-size: 19px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;

            border: 1px solid #dfe4ef;
            border-radius: 12px;

            padding: 13px 14px;

            font-size: 18px;
            outline: none;
            background: white;
        }

        .form-group input {
            height: 52px;
        }

        .form-group textarea {
            height: 130px;
            resize: vertical;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #4285ff;
        }

        .send-btn {
            border: none;

            padding: 14px 32px;

            border-radius: 13px;

            background: linear-gradient(
                90deg,
                #1677ff,
                #c126e8
            );

            color: white;

            font-size: 16px;
            font-weight: 700;

            cursor: pointer;
        }

        .send-btn:hover {
            opacity: 0.92;
        }

        .contact-info h2 {
            font-size: 32px;
            margin-bottom: 35px;
            color: #101b3c;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 26px;
        }

        .info-icon {
            width: 52px;
            height: 52px;

            flex-shrink: 0;

            border-radius: 13px;

            background: #e7f1ff;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 24px;
            color: #1677ff;
        }

        .info-text h3 {
            font-size: 20px;
            margin-bottom: 8px;
            color: #10182f;
        }

        .info-text p,
        .info-text a {
            font-size: 18px;
            color: #1768dc;
            text-decoration: none;
        }

        .info-text .support-text {
            color: #596179;
            font-size: 18px;
        }

        /* ================= ALERT MESSAGE ================= */

        .alert-success {
            width: 1600px;
            max-width: 120%;
            margin: 0 auto 30px;

            background: #d1fae5;
            color: #065f46;

            padding: 16px 20px;

            border-radius: 12px;

            font-size: 17px;
            font-weight: 600;
        }

        .alert-error {
            width: 1600px;
            max-width: 120%;
            margin: 0 auto 30px;

            background: #fee2e2;
            color: #991b1b;

            padding: 16px 20px;

            border-radius: 12px;

            font-size: 16px;
        }

        .alert-error ul {
            margin: 0;
            padding-left: 20px;
        }

        @media (max-width: 800px) {

            .contact-section {
                padding: 40px 15px 60px;
            }

            .contact-container {
                grid-template-columns: 1fr;
                max-width: 100%;
            }

            .heading h1 {
                font-size: 34px;
            }

            .contact-card {
                padding: 30px 25px;
            }

            .alert-success,
            .alert-error {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>

    <section class="contact-section">

        <!-- HEADING -->

        <div class="heading">

            <div class="subtitle">
                WE'RE HERE TO HELP
            </div>

            <h1>
                Get in touch
            </h1>

        </div>


        <!-- SUCCESS MESSAGE -->

        @if(session('success'))

            <div class="alert-success">
                {{ session('success') }}
            </div>

        @endif


        <!-- VALIDATION ERRORS -->

        @if($errors->any())

            <div class="alert-error">

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <!-- CONTACT CONTAINER -->

        <div class="contact-container">

            <!-- CONTACT FORM -->

            <div class="contact-card">

                <form
                    method="POST"
                    action="{{ route('contact.store') }}"
                >

                    @csrf


                    <div class="form-group">

                        <label>
                            Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Enter your name"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your email"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Message
                        </label>

                        <textarea
                            name="message"
                            placeholder="Write your message..."
                            required
                        >{{ old('message') }}</textarea>

                    </div>


                    <button
                        type="submit"
                        class="send-btn"
                    >
                        Send Message
                    </button>

                </form>

            </div>


            <!-- CONTACT INFO -->

            <div class="contact-card contact-info">

                <h2>
                    Contact info
                </h2>


                <!-- EMAIL -->

                <div class="info-item">

                    <div class="info-icon">
                        ✉
                    </div>

                    <div class="info-text">

                        <h3>
                            Email us
                        </h3>

                        <a href="mailto:zapmor.com@gmail.com">
                            zapmor.com@gmail.com
                        </a>

                    </div>

                </div>


                <!-- SUPPORT -->

                <div class="info-item">

                    <div class="info-icon">
                        🎧
                    </div>

                    <div class="info-text">

                        <h3>
                            Support
                        </h3>

                        <p class="support-text">
                            Available 24/7 in-app
                        </p>

                    </div>

                </div>


                <!-- APP -->

                <div class="info-item">

                    <div class="info-icon">
                        📱
                    </div>

                    <div class="info-text">

                        <h3>
                            Get the app
                        </h3>

                        <a href="#">
                            Download on Google Play
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>

</body>
</html>