<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .header-grid {
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            gap: 1rem;
        }

        @media (max-width: 767px) {
            .header-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }
            
            .header-grid .nav-buttons {
                margin-top: 1rem;
            }
        }
    </style>
</head>

<body class="container">
    <header class="header-grid mt-3">
        <div class="d-none d-md-block">
            <img src="{{ asset('storage/images/logo.png') }}" style="width: 4em" alt="Logo">
        </div>
        @if (Route::has('login'))
            <nav class="nav-buttons">
                @auth
                    <a class="btn bg-primary rounded-pill text-light fw-bold" href="{{ url('/dashboard') }}">
                        Dashboard
                    </a>
                @else
                    <a class="btn bg-primary rounded-pill text-light fw-bold" href="{{ route('login') }}">
                        Inicia sesión
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                        class="btn bg-primary rounded-pill text-light fw-bold">
                            Registrar
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <footer>

    </footer>
</body>

</html>
