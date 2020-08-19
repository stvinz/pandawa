<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.default.head')

        <title>@yield('title')</title>
    </head>
    <body>
        <div id="app">
            @include('components.default.header')

            <div class="container py-5" style="min-height: 85vh;">
                @yield('content')
            </div>
            
            @include('components.default.footer')
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset ('js/components/header.js') }}"></script>
    </body>
</html>
