<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <title>{{ $title }}</title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="d-flex align-items-center justify-content-between w-100">
                <a class="navbar-brand" href="{{ route('series.index') }}">Home</a>

                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-link">
                            Sair
                        </button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}">Entrar</a>
                @endguest
            </div>
        </nav>
    </div>
    <div class="container">
        <h1>{{ $title }}</h1>

        @isset($mensagemSucesso)
            <div class="alert alert-success">
                {{ $mensagemSucesso }}
            </div>
        @endisset

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{ $slot }}
    </div>
</body>

</html>
