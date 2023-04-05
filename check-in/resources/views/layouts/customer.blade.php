<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Check-In</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">


    <!-- Styles -->
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"
        integrity="sha512-..." crossorigin="anonymous" />

    <link rel="icon" type="image/png" href="{{ asset('storage/logo/logo.png') }}">
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"
        integrity="sha512-QN1HhIS1ZRXeNvcIk80PnB63RDTybhOJybrj0zB9Hvdpoc+JdHL1h/hpJH7J0+elREonclK6an/eJdNYsh+YXg=="
        crossorigin="anonymous"></script>

    <link rel="icon" type="image/png" href="{{ asset('storage/logo/logo.png') }}">

    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    @stack('scripts')
</head>
<header>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('storage/logo/logo.png') }}" alt="" width="150" height="100">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item me-5">
                    <a class="nav-link" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item ms-5 me-5">
                    <a class="nav-link" href="#">Make Reservation</a>
                </li>
                <li class="nav-item ms-5 me-5">
                    <a class="nav-link" href="#">Reservation List</a>
                </li>
                <li class="nav-item ms-5 me-5">
                    <a class="nav-link" href="#">Manage Cart</a>
                </li>
                <li class="nav-item ms-5 me-5">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item ms-5">
                    <a class="nav-link" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Log Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                </li>
                {{-- <li class="nav-item dropdown ms-5">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Welcome!
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </li> --}}
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Welcome {{ Auth::user()->name }} Welcome!
                    {{-- </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Log Out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>
</header>
<body style="background-color: #D3D3D3;">
    {{-- <p class="text-center">Center aligned text on all viewport sizes.</p> --}}
    <div>
        {{ $slot }}
    </div>
</body>
<footer class="bg-light py-3">

</footer>
</html>
