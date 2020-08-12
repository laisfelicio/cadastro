
<html>
    <head>
        <link href = "{{asset('css/app.css')}}" rel = "stylesheet">
        <script scr = "{{ asset('js/app.js')}}" type = "text/javascript"> </script>
        <title> Testes </title>
        <meta name = "csrf-token" content = "{{ csrf_token() }}">
        <style>
            body{
                padding: 20px;
            }
            .navbar{
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        
        <div class = "container">
            @component('component_navbarnovo')
            @endcomponent
            <main role = "main">
                @hasSection('body')
                @yield('body')
                @endif
            </main>
        </div>
        
    </body>
</html>