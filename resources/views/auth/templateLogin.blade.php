<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('/assets/css/app.min.css')}}">
        <script language="javascript" src=" {{ asset('assets/js/javascript.js')}} "></script>
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('/assets/img/logoMonBouc.png')}}" />
        <title>Mon Bouc - {{ $title ?? '' }}</title>
    </head>
    <body>
        @yield('content')
    </body>
</html> 