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

            <v-btn text color="grey darken-1" href="/student/main">
                    <span>top page</span>
            </v-btn>
            <v-menu
                top
                offset-y
                :close-on-content-click="closeOnContentClick"
            >
                <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            color="primary"
                            text
                            v-bind="attrs"
                            v-on="on"
                        >
                            <span class="mr-1">sign in</span>  
                        </v-btn>
                </template>
                <v-list>
                    <v-list-item
                        href="/student/login-main"
                    >
                        <v-list-item-action>
                            <v-icon class="grey--text text--darken-3">mdi-login-variant</v-icon>
                        </v-list-item-action>
                        <v-list-item-action>
                            <v-list-item-title class="grey--text text--darken-3">Log in</v-list-item-title>
                        </v-list-item-action>
                    </v-list-item>
                    <v-list-item
                        href="/student/register-main"
                    >
                        <v-list-item-action>
                            <v-icon class="grey--text text--darken-3">mdi-account-plus-outline</v-icon>
                        </v-list-item-action>
                        <v-list-item-action>
                            <v-list-item-title class="grey--text text--darken-3">Register</v-list-item-title>
                        </v-list-item-action>
                    </v-list-item>
                </v-list>
            </v-menu>
            <!-- <v-btn 
                text color="primary" 
                href="/student/login-main"
            >
                <span>login</span>
            </v-btn>
            <v-btn 
                text color="primary" 
                href="/student/register-main"
            >
                <span>register</span>
            </v-btn> -->
            </v-app-bar>
        </nav>
   
        <v-main class="py-4">
            @yield('content')
        </v-main>
    </v-app>
    </div>
</body>
</html>
