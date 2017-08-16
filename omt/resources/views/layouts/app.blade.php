<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>{{config('app.name','OMT')}}</title>

    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/map.css')}}" rel="stylesheet">

</head>
<body>
<!-- NavBar -->
<div id="app">
    @include('inc.navbar')
    <div class="container">
        @include('inc.messages')
        @yield('content')
    </div>
</div>

<!-- Scripts -->
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/mapscript.js')}}"></script>

<!-- Text editor -->
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'article-ckeditor' );
</script>

<!-- Google Maps Script-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-2Iztq_BI7RcU5cNIvAExmHseeUEPJpE"
        async defer>
</script>

</body>
</html>
