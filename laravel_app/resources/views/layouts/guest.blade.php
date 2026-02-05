<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center pt-4 bg-light">
            <div class="mb-4">
                <a href="/" class="text-decoration-none">
                    <h2 class="text-primary">{{ config('app.name', 'Laravel') }}</h2>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="card shadow">
                    <div class="card-body">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
