<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Zapmor</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background:
                radial-gradient(circle at top left, #dcecff 0%, transparent 35%),
                radial-gradient(circle at bottom right, #f7dcff 0%, transparent 35%),
                #f7f8fc;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 25px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 430px;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo a {
            text-decoration: none;
            font-size: 32px;
            font-weight: 800;

            background: linear-gradient(
                90deg,
                #286eff,
                #c127e8
            );

            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.96);

            border-radius: 18px;

            padding: 38px 34px;

            box-shadow:
                0 20px 55px rgba(42, 57, 120, 0.12);

            border: 1px solid #edf0f6;
        }

        .login-card h1 {
            text-align: center;
            color: #10182f;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .login-subtitle {
            text-align: center;
            color: #697386;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #20283b;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            height: 48px;

            border: 1px solid #d7dce8;
            border-radius: 10px;

            padding: 0 14px;

            font-size: 15px;

            outline: none;

            background: #fff;
        }

        .form-group input:focus {
            border-color: #3479ff;

            box-shadow:
                0 0 0 3px rgba(52, 121, 255, 0.10);
        }

        .error-message {
            background: #fff0f0;
            color: #c62828;

            border: 1px solid #ffd2d2;

            border-radius: 9px;

            padding: 11px 13px;

            margin-bottom: 20px;

            font-size: 14px;
        }

        .success-message {
            background: #eefbf2;
            color: #1f7a3f;

            border: 1px solid #c9efd4;

            border-radius: 9px;

            padding: 11px 13px;

            margin-bottom: 20px;

            font-size: 14px;
        }

        .login-btn {
            width: 100%;
            height: 50px;

            border: none;
            border-radius: 10px;

            background: #111827;

            color: white;

            font-size: 15px;
            font-weight: 700;

            cursor: pointer;

            transition: 0.2s;
        }

        .login-btn:hover {
            background: #1f2937;

            transform: translateY(-1px);
        }

        .bottom-text {
            text-align: center;

            margin-top: 22px;

            font-size: 14px;

            color: #6b7280;
        }

        .bottom-text a {
            color: #2575ff;

            text-decoration: none;

            font-weight: 600;
        }

        .home-link {
            display: block;

            text-align: center;

            margin-top: 18px;

            font-size: 14px;

            color: #667085;

            text-decoration: none;
        }

        .home-link:hover {
            color: #2575ff;
        }

        @media (max-width: 500px) {
            .login-card {
                padding: 30px 22px;
            }

            .login-card h1 {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <div class="logo">
        <a href="{{ url('/') }}">Zapmor</a>
    </div>

    <div class="login-card">

        <h1>Welcome Back</h1>

        <p class="login-subtitle">
            Login to your Zapmor account
        </p>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST">

            @csrf

            <div class="form-group">
                <label for="email">Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    required
                    autofocus
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

            <button type="submit" class="login-btn">
                LOG IN
            </button>

        </form>

        <div class="bottom-text">
            Don't have an account?
            <a href="{{ route('register') }}">Register</a>
        </div>

        <a href="{{ url('/') }}" class="home-link">
            ← Back to Home
        </a>

    </div>

</div>

</body>
</html>