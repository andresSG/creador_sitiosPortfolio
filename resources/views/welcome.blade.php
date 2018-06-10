<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/fontawesome-all.min.css') }}" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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
                font-size: 60px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .links2 > a {
                color: #414532;
                padding: 0 25px;
                font-size: 20px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                position: relative;
                bottom: -160px;
            }
            .h4n {
                color: #414532;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                position: relative;
                bottom: -160px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{ config('app.name', 'Laravel') }}
                </div>

                <div class="links2">
                    <h4 class="h4n">Teconologias y referencias</h4>
                    <a href="https://laravel.com/docs"><i class="fab fa-laravel fa-2x" title="Laravel"></i></a>
                    <a href="https://php.net/"><i class="fab fa-php fa-2x" title="Php"> </i></a>
                    <a href="https://fontawesome.com/"><i class="fab fa-font-awesome-flag fa-2x" title="Font Awesome"></i></a>
                    <a href="https://twitter.com/CasualAskep"><i class="fab fa-twitter fa-2x" title="@CasualAskep"> </i></a>
                    <a href="https://github.com/andresSG/creador_sitiosPortfolio"><i class="fab fa-github-square fa-2x" title="GitHub repo"></i></a>
                    <a href="https://mariadb.org/"><i class="fas fa-database fa-2x" title="MariaDB"> </i></a>
                    <a href="https://colorlib.com/wp/template/glint/"><i class="fas fa-leaf fa-2x" title=" Template html"></i></a>
                </div>
            </div>
        </div>
    </body>
</html>
