<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login | School Management</title>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Bootstrap Icons --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

</head>


<body class="min-h-screen bg-slate-100 flex items-center justify-center px-4 py-8">


    <div class="w-full max-w-md">


        {{-- =========================================================
             LOGO / HEADER
        ========================================================== --}}

        <div class="text-center mb-6">

            <div
                class="w-16 h-16 mx-auto rounded-2xl
                       bg-blue-600 text-white
                       flex items-center justify-center
                       shadow-lg shadow-blue-600/20">

                <i class="bi bi-mortarboard-fill text-3xl"></i>

            </div>


            <h1 class="mt-4 text-2xl sm:text-3xl font-bold text-slate-800">

                School Management System

            </h1>


            <p class="mt-2 text-sm text-slate-500">

                Sign in to your administrator account

            </p>

        </div>



        {{-- =========================================================
             LOGIN CARD
        ========================================================== --}}

        <div
            class="bg-white rounded-2xl
                   shadow-xl shadow-slate-200/60
                   border border-slate-200
                   p-6 sm:p-7">


            {{-- Success Message --}}

            @if(session('success'))

                <div
                    class="mb-5 flex items-start gap-3
                           rounded-xl
                           bg-green-50
                           border border-green-200
                           px-4 py-3
                           text-sm text-green-700">

                    <i class="bi bi-check-circle-fill mt-0.5"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif



            {{-- Error Message --}}

            @if($errors->any())

                <div
                    class="mb-5
                           rounded-xl
                           bg-red-50
                           border border-red-200
                           px-4 py-3">

                    <div class="flex items-center gap-2 mb-2">

                        <i class="bi bi-exclamation-circle-fill text-red-600"></i>

                        <p class="text-sm font-semibold text-red-700">

                            Login failed

                        </p>

                    </div>


                    <ul class="space-y-1 text-sm text-red-600">

                        @foreach($errors->all() as $error)

                            <li class="flex gap-2">

                                <span>•</span>

                                <span>
                                    {{ $error }}
                                </span>

                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif



            {{-- =====================================================
                 LOGIN FORM
            ====================================================== --}}

            <form
                method="POST"
                action="{{ route('login.store') }}"
                class="space-y-5">

                @csrf



                {{-- Email --}}

                <div>

                    <label
                        for="email"
                        class="block
                               text-sm
                               font-semibold
                               text-slate-700
                               mb-2">

                        Email Address

                    </label>


                    <div class="relative">

                        <div
                            class="absolute inset-y-0 left-0
                                   flex items-center
                                   pl-3.5
                                   pointer-events-none">

                            <i class="bi bi-envelope text-slate-400"></i>

                        </div>


                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="email"
                            placeholder="Enter your email"

                            class="w-full
                                   rounded-xl
                                   border border-slate-300
                                   bg-white
                                   pl-10 pr-4 py-3
                                   text-sm text-slate-800
                                   placeholder:text-slate-400
                                   outline-none
                                   transition
                                   focus:border-blue-500
                                   focus:ring-4
                                   focus:ring-blue-100">

                    </div>

                </div>



                {{-- Password --}}

                <div>

                    <div class="flex items-center justify-between mb-2">

                        <label
                            for="password"
                            class="block
                                   text-sm
                                   font-semibold
                                   text-slate-700">

                            Password

                        </label>

                    </div>


                    <div class="relative">

                        <div
                            class="absolute inset-y-0 left-0
                                   flex items-center
                                   pl-3.5
                                   pointer-events-none">

                            <i class="bi bi-lock text-slate-400"></i>

                        </div>


                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Enter your password"

                            class="w-full
                                   rounded-xl
                                   border border-slate-300
                                   bg-white
                                   pl-10 pr-11 py-3
                                   text-sm text-slate-800
                                   placeholder:text-slate-400
                                   outline-none
                                   transition
                                   focus:border-blue-500
                                   focus:ring-4
                                   focus:ring-blue-100">


                        {{-- Show / Hide Password --}}

                        <button
                            type="button"
                            onclick="togglePassword()"

                            class="absolute
                                   inset-y-0
                                   right-0
                                   flex items-center
                                   pr-3.5
                                   text-slate-400
                                   hover:text-slate-600">

                            <i
                                id="passwordIcon"
                                class="bi bi-eye">
                            </i>

                        </button>

                    </div>

                </div>



                {{-- Remember Me --}}

                <div class="flex items-center justify-between">


                    <label
                        class="inline-flex
                               items-center
                               gap-2
                               cursor-pointer
                               text-sm
                               text-slate-600">

                        <input
                            type="checkbox"
                            name="remember"
                            value="1"

                            class="h-4 w-4
                                   rounded
                                   border-slate-300
                                   text-blue-600
                                   focus:ring-blue-500">

                        <span>
                            Remember me
                        </span>

                    </label>


                </div>



                {{-- Login Button --}}

                <button
                    type="submit"

                    class="w-full
                           inline-flex
                           items-center
                           justify-center
                           gap-2
                           rounded-xl
                           bg-blue-600
                           px-4 py-3
                           text-sm
                           font-semibold
                           text-white
                           shadow-sm
                           shadow-blue-600/20
                           transition
                           hover:bg-blue-700
                           hover:shadow-md
                           focus:outline-none
                           focus:ring-4
                           focus:ring-blue-100">

                    <i class="bi bi-box-arrow-in-right text-lg"></i>

                    Sign In

                </button>


            </form>

        </div>



        {{-- Footer --}}

        <p
            class="text-center
                   text-xs
                   text-slate-400
                   mt-6">

            © {{ date('Y') }} School Management System

        </p>


    </div>



    {{-- =========================================================
         PASSWORD TOGGLE
    ========================================================== --}}

    <script>

        function togglePassword() {

            const password = document.getElementById('password');

            const icon = document.getElementById('passwordIcon');


            if (password.type === 'password') {

                password.type = 'text';

                icon.classList.remove('bi-eye');

                icon.classList.add('bi-eye-slash');

            } else {

                password.type = 'password';

                icon.classList.remove('bi-eye-slash');

                icon.classList.add('bi-eye');

            }

        }

    </script>

</body>

</html>