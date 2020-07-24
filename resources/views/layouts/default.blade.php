<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.head')

        <title>PT. Sumber Jaya Pandawa - @yield('title')</title>
    </head>
    <body>
        <div id="app">
            @include('components.header')

            <div class="container py-5">
                @yield('content')
            </div>
            
            @include('components.footer')
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
