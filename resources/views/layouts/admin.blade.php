<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin dashboard</title>
    <!-- Scripts -->
    @vite(['resources/sass/admin.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="admin-dashboard">
        {{-- Navbar --}}
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    Dashboard
                </a>



                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="navitem">
                            <a class="nav-link" href="{{ route('admin.dishes.trashed') }}">Piatti fuori menù</a>
                        </li>
                        <li class="navitem">
                            <a class="nav-link" href="{{ route('admin.dishes.index') }}">Piatti</a>
                        </li>

                        <li class="navitem">
                            <a class="nav-link" href="#{{-- {{ route('admin.orders.index') }} --}}">Ordini</a>
                        </li>
                        <li class="navitem">
                            <a class="nav-link" href="#{{-- {{ route('admin.statistics') }} --}}">Statistiche</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout &nbsp;<i class="fa-solid fa-arrow-right-from-bracket"></i>

                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        {{-- Main content --}}

        <main class="py-4">
            <div class="container-fluid w-100 d-flex justify-content-center">
                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>
