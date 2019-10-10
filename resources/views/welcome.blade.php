<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
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

        /* AJOUTER BY ME */

        h1 {
            background-color: #4c81c9;
            color: white;
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

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            CPNV Store
        </div>
        <form method="post" action="/applications/new">
            @csrf <!-- génération d'un token, protection contre les attaques de type Cross Site Request Forgery -->
            <label>Nom de l'application</label>
            <input type="text" name="newname">
            <select name="category">
                <option value="0">-- Choisir --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id  }}"> {{ $cat->name }}</option>
                @endforeach
                <input type="submit" value="Envoyer">
            </select>

        </form>
        <div>
            <h1>Applications</h1>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Catégorie</th>
                    <th>Plateformes</th>
                    <th>Utilisateurs</th>
                </tr>
                @foreach($apps as $app)
                    <tr>
                        <td><a href="/details/{{ $app->id }}">{{ $app->name }}</a></td>
                        <td>{{ $app->description  }}</td>
                        <td>{{ $app->category->name  }}</td>
                        <td>
                            @foreach($app->platforms as $plt)
                                {{ $plt->name }} ({{ $plt->pivot->minversion }}), <a href="{{ $plt->pivot->installer }}">Téléchargement</a>
                            @endforeach
                        </td>
                        <td>
                            @foreach($app->users as $user)
                                {{ $user->firstname }}  ({{ \App\Role::find($user->pivot->role_id)->name }})

                            @endforeach
                        </>

                    </tr>
                @endforeach
            </table>
        </div>
        <div>
            <h1>Catégories</h1>
            @foreach($categories as $cat)
                <div>
                    {{ $cat->name }}
                    @if ($cat->applications->count() == 0)
                        Aucune
                    @else
                        @foreach($cat->applications as $app)
                            {{ $cat->applications->count() }} application : {{ $app->name }}
                        @endforeach
                    @endif
                </div>
            @endforeach
            <h1>Plateformes</h1>
            @foreach($plateformes as $plat)
                <div>
                    {{ $plat->name }}
                    @if ($plat->applications->count() == 0)
                        Aucune
                    @else
                        @foreach($plat->applications as $app)
                            {{ $app->application_id }} {{ $app->name }}
                        @endforeach
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
</body>
</html>
