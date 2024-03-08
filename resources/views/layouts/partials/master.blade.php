<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partials.header')
</head>
<body class="sb-nav-fixed">
    @include('layouts.partials.navbar')
    @include('layouts.partials.sidebar')

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')
    @yield('script')
    @include('layouts.partials.footerscript')
</body>
</html>
