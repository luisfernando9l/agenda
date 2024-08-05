<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" crossorigin="anonymous">

        <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFgVozNkH8rqXDDnBPotX6-kz6rxIU17c&libraries=geometry,drawing,places&callback=Function.prototype&loading=async"
        ></script>

        <!-- Scripts -->
        <script src="{{ asset('js/chart.min.js')}}" ></script>
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue", 'resources/js/Helpers/simplify.js'])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
