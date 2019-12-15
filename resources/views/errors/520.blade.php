<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
        <link href="{{asset('css/estilos.css')}}" rel="stylesheet">
        <script type="text/javascript" src="{{ URL::asset('js/jquery-2.1.4.js') }}"></script> 
        <script src="{{asset('js/bootstrap.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/validacionLogin.js')}}" type="text/javascript"></script>
    </head>
    <body class="container-fluid badge-dark">
        <div class="row mt-5">
            <div class="col-xl-4 col-lg-4 col-md-2 col-sm-1 col-1"></div>
            <div class="col-xl-4 col-lg-4 col-md-8 col-sm-10 col-10 mt-5 mb-5 cajaIndex">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1>Error 520, inicie session como administrador antes de acceder a esta pagina.</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <a class="text-primary text-left" href="index"> Iniciar sesión</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-2 col-sm-1 col-1"></div>
        </div>
    </body>
</html>