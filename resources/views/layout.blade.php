<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script type="text/javascript" src="{{ asset('js/utils.js?v=1') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css?v=1') }}" />
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">Logo</a>
            <a class="nav-link dropdown-toggle" href="#" id="userNameDropdown" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @guest
                    <a role="button" href="{{ route('login.index') }}" class="btn btn-primary">Entrar</a>
                @else
                    <div class="dropdown">
                        Olá, {{ Auth::user()->name }}
                    @endguest
            </a>
            @auth
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="userNameDropdown">
                    <li><a class="dropdown-item" href="{{ route('login.destroy') }}">Logout</a></li>
                    <li><a class="dropdown-item" href="#">Ver Carrinho</a></li>
                </ul>
            </div>
        @endauth
        </div>
    </nav>

    </nav>
    <main>
        <div class="container mt-4">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
    </main>
    <footer class="footer p-2 mt-5">
        <div class="text-center text-sm ">
            Todos os direitos reservados, {{ date('Y') }}
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
