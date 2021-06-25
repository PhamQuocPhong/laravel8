<html>
<head>
     @include('layouts.partials.head')
</head>
<body>

<div id="wrapper">

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
        @include('layouts.partials.header')
        @include('layouts.partials.sidebar')
    </nav>

    <div id="page-wrapper" style="min-height: 886px;">
        @yield('content')
    </div>

</div>
@yield('js')  
</body>
</html>