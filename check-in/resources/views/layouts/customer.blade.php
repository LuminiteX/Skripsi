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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-+8twhnV7X9y+CXEob2xl3e5YiQ2CBtcE5GrzAr5pHlG09El+F7X9avtRpDIfxOrL" crossorigin="anonymous">
    </script>

    <link rel="icon" type="image/png" href="{{ asset('storage/logo/logo.png') }}">
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"
        integrity="sha512-QN1HhIS1ZRXeNvcIk80PnB63RDTybhOJybrj0zB9Hvdpoc+JdHL1h/hpJH7J0+elREonclK6an/eJdNYsh+YXg=="
        crossorigin="anonymous"></script> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script> --}}



    <link rel="icon" type="image/png" href="{{ asset('storage/logo/logo.png') }}">

    <script src="https://kit.fontawesome.com/b63c8b9802.js" crossorigin="anonymous"></script>

    {{-- <script src="{{ asset('js/moment.min.js') }}"></script> --}}
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
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
                        <a class="nav-link" href="{{ route('restaurants.list') }}">Make Reservation</a>
                    </li>
                    <li class="nav-item ms-5 me-5">
                        <a class="nav-link" href="#">Reservation List</a>
                    </li>
                    <li class="nav-item ms-5 me-5">
                        <a class="nav-link" href="#">Manage Cart</a>
                    </li>
                    <li class="nav-item ms-5 me-5">
                        <a class="nav-link" href="{{ route('customer.show.profile') }}">Profile</a>
                    </li>
                    <li class="nav-item ms-5">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Log Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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

{{-- <body class="d-flex flex-column min-vh-100" style="background-color: #D3D3D3;"> --}}

<body class="d-flex flex-column min-vh-100">
    {{-- <p class="text-center">Center aligned text on all viewport sizes.</p> --}}
    {{ $slot }}
</body>

<footer class="bg-light py-3 mt-auto">

</footer>

</html>
