<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Create Account</title>

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
            font-family:
                Inter,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Roboto,
                Arial,
                sans-serif;
        }

        body {
            background: #f1f5f9;
            color: #1e293b;
        }


        /* ========================================
           Main
        ======================================== */

        .auth-wrapper {
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 30px 16px;
        }


        .auth-container {
            width: 100%;
            max-width: 430px;
        }


        /* ========================================
           Card
        ======================================== */

        .auth-card {
            background: #ffffff;

            border: 1px solid #e2e8f0;

            border-radius: 16px;

            overflow: hidden;

            box-shadow:
                0 10px 30px rgba(15, 23, 42, 0.08);
        }


        /* ========================================
           Header
        ======================================== */

        .auth-header {
            text-align: center;

            padding: 30px 25px 25px;

            border-bottom: 1px solid #e2e8f0;
        }


        .auth-icon {
            width: 58px;
            height: 58px;

            margin: 0 auto 15px;

            border-radius: 14px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #eff6ff;

            color: #2563eb;

            font-size: 25px;
        }


        .auth-title {
            margin: 0;

            font-size: 23px;

            font-weight: 700;

            color: #1e293b;
        }


        .auth-subtitle {
            margin: 7px 0 0;

            font-size: 13px;

            color: #64748b;
        }


        /* ========================================
           Body
        ======================================== */

        .auth-body {
            padding: 25px;
        }


        /* ========================================
           Alerts
        ======================================== */

        .alert {
            padding: 12px 14px;

            border-radius: 8px;

            margin-bottom: 18px;

            font-size: 13px;
        }


        .alert-error {
            color: #b91c1c;

            background: #fef2f2;

            border: 1px solid #fecaca;
        }


        .alert-success {
            color: #15803d;

            background: #f0fdf4;

            border: 1px solid #bbf7d0;
        }


        .alert ul {
            margin: 0;

            padding-left: 18px;
        }


        .alert li {
            margin-bottom: 3px;
        }


        /* ========================================
           Form
        ======================================== */

        .form-group {
            margin-bottom: 17px;
        }


        .form-label {
            display: block;

            margin-bottom: 7px;

            font-size: 13px;

            font-weight: 600;

            color: #334155;
        }


        .form-control,
        .form-select {
            width: 100%;

            height: 43px;

            padding: 0 12px;

            border: 1px solid #cbd5e1;

            border-radius: 8px;

            background: #ffffff;

            color: #334155;

            font-size: 14px;

            outline: none;

            transition:
                border-color .2s ease,
                box-shadow .2s ease;
        }


        .form-control::placeholder {
            color: #94a3b8;
        }


        .form-control:focus,
        .form-select:focus {
            border-color: #3b82f6;

            box-shadow:
                0 0 0 3px rgba(59, 130, 246, .10);
        }


        /* ========================================
           Button
        ======================================== */

        .btn-register {
            width: 100%;

            height: 43px;

            border: 0;

            border-radius: 8px;

            background: #2563eb;

            color: #ffffff;

            font-size: 14px;

            font-weight: 600;

            cursor: pointer;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            transition:
                background .2s ease,
                transform .1s ease;
        }


        .btn-register:hover {
            background: #1d4ed8;
        }


        .btn-register:active {
            transform: scale(.99);
        }


        /* ========================================
           Login
        ======================================== */

        .login-link {
            text-align: center;

            margin-top: 20px;

            padding-top: 18px;

            border-top: 1px solid #f1f5f9;

            font-size: 13px;

            color: #64748b;
        }


        .login-link a {
            margin-left: 5px;

            color: #2563eb;

            font-weight: 600;

            text-decoration: none;
        }


        .login-link a:hover {
            color: #1d4ed8;

            text-decoration: underline;
        }


        /* ========================================
           Responsive
        ======================================== */

        @media (max-width: 480px) {

            .auth-wrapper {
                padding: 15px;
            }

            .auth-header {
                padding: 25px 20px 20px;
            }

            .auth-body {
                padding: 20px;
            }

            .auth-title {
                font-size: 21px;
            }

        }

    </style>

</head>


<body>


<div class="auth-wrapper">

    <div class="auth-container">

        <div class="auth-card">


            {{-- =====================================
                 Header
            ====================================== --}}

            <div class="auth-header">

                <div class="auth-icon">

                    <i class="bi bi-person-plus"></i>

                </div>


                <h1 class="auth-title">
                    Create Account
                </h1>


                <p class="auth-subtitle">
                    Register a new user account
                </p>

            </div>


            {{-- =====================================
                 Body
            ====================================== --}}

            <div class="auth-body">


                {{-- Errors --}}

                @if($errors->any())

                    <div class="alert alert-error">

                        <ul>

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                {{-- Success --}}

                @if(session('success'))

                    <div class="alert alert-success">

                        {{ session('success') }}

                    </div>

                @endif


                {{-- =================================
                     Form
                ================================== --}}

                <form method="POST"
                      action="{{ route('register.store') }}">

                    @csrf


                    {{-- Name --}}

                    <div class="form-group">

                        <label class="form-label">
                            Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Enter your name"
                            required
                            autofocus
                            class="form-control"
                        >

                    </div>


                    {{-- Email --}}

                    <div class="form-group">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter email address"
                            required
                            class="form-control"
                        >

                    </div>


                    {{-- Branch --}}

                    <div class="form-group">

                        <label class="form-label">
                            Branch
                        </label>

                        <select
                            name="branch_id"
                            required
                            class="form-select"
                        >

                            <option value="">
                                Select Branch
                            </option>

                            @foreach($branches as $branch)

                                <option
                                    value="{{ $branch->id }}"
                                    {{ old('branch_id') == $branch->id ? 'selected' : '' }}
                                >

                                    {{ $branch->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Password --}}

                    <div class="form-group">

                        <label class="form-label">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            placeholder="Minimum 8 characters"
                            required
                            class="form-control"
                        >

                    </div>


                    {{-- Confirm Password --}}

                    <div class="form-group">

                        <label class="form-label">
                            Confirm Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            placeholder="Confirm password"
                            required
                            class="form-control"
                        >

                    </div>


                    {{-- Register Button --}}

                    <button
                        type="submit"
                        class="btn-register"
                    >

                        <i class="bi bi-person-plus"></i>

                        Create Account

                    </button>


                </form>


                {{-- Login --}}

                <div class="login-link">

                    Already have an account?

                    <a href="{{ route('login') }}">
                        Login
                    </a>

                </div>


            </div>

        </div>

    </div>

</div>


</body>

</html>