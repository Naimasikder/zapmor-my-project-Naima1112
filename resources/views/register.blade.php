<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Zapmor</title>

    @vite(['resources/css/app.css'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
        }

        .register-container {
            width: 100%;
            max-width: 500px;
            background: #ffffff;
            padding: 40px 45px;
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.10);
        }

        .register-container h2 {
            margin: 0 0 8px;
            text-align: center;
            font-size: 32px;
            color: #111827;
        }

        .subtitle {
            text-align: center;
            color: #6b7280;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
            font-weight: 600;
            color: #374151;
        }

        .form-group input {
            width: 100%;
            padding: 14px 15px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 16px;
            outline: none;
            transition: 0.2s;
        }

        .form-group input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
        }

        .error-box {
            background: #fee2e2;
            color: #b91c1c;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .error-box p {
            margin: 4px 0;
        }

        .register-btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: #2563eb;
            color: #ffffff;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .register-btn:hover {
            background: #1d4ed8;
        }

        .bottom-text {
            margin-top: 25px;
            text-align: center;
            font-size: 15px;
            color: #6b7280;
        }

        .bottom-text a {
            color: #2563eb;
            font-weight: 600;
            text-decoration: none;
        }

        .bottom-text a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .register-container {
                width: 92%;
                padding: 30px 25px;
            }

            .register-container h2 {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>

    <div class="register-container">

        <h2>Create Account</h2>

        <div class="subtitle">
            Register to book your appointment with Zapmor
        </div>

        @if ($errors->any())
            <div class="error-box">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ url('/register') }}">
            @csrf

            <div class="form-group">
                <label for="name">Full Name</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter your full name"
                    required
                >
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Confirm your password"
                    required
                >
            </div>

            <button type="submit" class="register-btn">
                Create Account
            </button>
        </form>

        <div class="bottom-text">
            Already have an account?
            <a href="{{ route('login') }}">Login</a>
        </div>

    </div>

</body>
</html>
