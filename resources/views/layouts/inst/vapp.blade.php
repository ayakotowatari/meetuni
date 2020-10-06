<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('js')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
    <v-app>
        <nav>
            <v-app-bar
            flat app color="white"
            >
            <v-toolbar-title>
                <span class="font-weight-bold primary--text">meet<span class="font-weight-light">Uni</span></span> 
            </v-toolbar-title>
            <v-spacer></v-spacer>

            <v-btn text color="grey darken-1" href="/institution">
                    <span>top page</span>
            </v-btn>
            <v-btn 
                text color="primary" 
                href="/institution/login"
            >
                <span>login</span>
            </v-btn>
            </v-app-bar>
        </nav>
   
        <v-main class="py-4">
            @yield('content')
        </v-main>
    </v-app>
    </div>
</body>
</html>
