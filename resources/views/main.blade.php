<html>
    <head>
        <title>@yield('title')</title>
        @include('stack.css')
        @include('stack.meta')
        @stack('common-meta')
        @stack('global-styles')
    </head>
    <body>
        @include('component.nav')
        @include('component.alert')
        @section('sidebar')
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>
    @include('stack.javascript')
    @stack('global-scripts')
    @stack('custom-js')
</html>