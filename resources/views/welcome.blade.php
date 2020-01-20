<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> Конструктор анкет </title>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
                flex-direction: column;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>

    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ route('form.my') }}"> Мои формы </a>
            @else
                <a href="{{ route('login') }}">Войти</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Зарегестрироваться</a>
                @endif
            @endauth
        </div>
    @endif

        <div class="row justify-content-center">

                    <div class="flex-center position-ref full-height" id="app">
                            <div class="title m-b-md">
                                Конструктор анкет
                            </div>

                            <div class="links">
                                <show-input-form
                                    :action="'{{ route('form.show', '') }}'"
                                ></show-input-form>
                            </div>
                </div>
            </div>

    </body>
</html>
