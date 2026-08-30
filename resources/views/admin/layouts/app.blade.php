<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Dashboard') 
        - {{ config('app.name') }}
    </title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>

    @stack('styles')
</head>

<body class="bg-slate-100 text-slate-800">

    <div class="min-h-screen">

        {{-- Sidebar --}}
        @include('admin.layouts.sidebar')

        {{-- Main Content --}}
        <div class="lg:ml-64">

            {{-- Navbar --}}
            @include('admin.layouts.navbar')

            <main class="p-4 sm:p-6 lg:p-8">
                @yield('content')
            </main>

        </div>

    </div>

    @stack('scripts')
<script>

function toggleNavGroup(button) {

    const submenu = button.nextElementSibling;
    const isOpen = !submenu.classList.contains('hidden');

    // Close all other groups
    document.querySelectorAll('.nav-submenu').forEach(menu => {
        menu.classList.add('hidden');
    });

    document.querySelectorAll('.nav-group-title').forEach(title => {
        title.classList.remove('active');
    });


    // Open selected group
    if (!isOpen) {

        submenu.classList.remove('hidden');

        button.classList.add('active');

    }

}

</script>
</body>
</html>