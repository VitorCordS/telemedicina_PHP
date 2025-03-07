<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('view-title')</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>

    {{-- Header do Telemedicina --}}
    <header class="pb-5 mb-4">
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
            <div class="container-fluid px-5 py-2">

                {{-- Logo do Telemedicina --}}
                <a class="navbar-brand" href="#">Telemedicina👨‍⚕️</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                {{-- Conteúdo da Navbar --}}
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                    {{-- Links --}}
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : ''}}" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('types') ? 'active' : ''}}" href="/types">Tipos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('exams') ? 'active' : ''}}" href="/exams">Exames</a>
                        </li>
                    </ul>

                </div>

            </div>
        </nav>
    </header>

    <!-- Slot em branco para inserir conteúdo no layout -->
    @yield('content')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>