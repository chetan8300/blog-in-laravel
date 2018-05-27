<!DOCTYPE html>
<!--suppress ALL -->
<html lang="en">
    <head>
        @include('partials._head')
    </head>

    <body>
    @include('partials._nav')
        <div class="container">
            @include('partials._messages')

            @yield('content')

            <hr>
            @include('partials._footer')

        </div> <!--End of container--!>

        @include('partials._javascripts')

        @yield('scripts')

    </body>
</html>