<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>{{ config('app.name', 'Laravel') }}</title>

      <!-- Styles -->
      <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  </head>
  <body>
    <div id="app">
      <v-app>
        <!-- これがさっき修正したファイル -->
        <example-component></example-component>
      </v-app>
    </div>
    
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
  </body>
</html>