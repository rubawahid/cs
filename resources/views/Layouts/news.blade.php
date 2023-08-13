<html>
    <head>
        <title>
            @yield('title')
        </title>
    </head>
    <body dir='rtl'>
        @section ('sedebar')
             هنا سوف نعرض لكم أخبار العالم
        @show

        <div class="continer">
            @yield('content')
        </div>
    </body>
</html>