<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> @yield('page-title',"Login your existing account")</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    @yield('content')
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- Sweet Alert --}}
    @include('sweetalert::alert')
</body>

</html>
