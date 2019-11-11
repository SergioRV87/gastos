<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="{{ URL::asset('js/jquery-2.1.4.js') }}"></script> 
        <script src="{{asset('js/bootstrap.js')}}" type="text/javascript"></script>
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    </head>
    <body class="container-fluid badge-dark">
        <div class="row mt-3">
            <div class="col-3"></div>
            <div class="col-6 p-5 cajaIndex">
                <div class="row pb-4">
                    <label class="col-12 text-left">¿ya tiene una cuenta? <a class="text-left" href="index">Iniciar sesión</a></label>
                </div>
                <form name="form" class="row" action="nuevoregistro" method="POST">
                    {!! csrf_field(); !!}
                    <div class="col-12">
                        <div class="row pb-3">  
                            <div class="col-1"></div>
                            <input class="col-5 p-1 mr-2 text-center" type="text" name="nombre" placeholder="nombre">
                            <input class="col-5 p-1 ml-2 text-center" type="text" name="apellidos" placeholder="apellidos">
                            <div class="col-1"></div>
                        </div>
                        <div class="row pb-3">
                            <div class="col-1"></div>
                            <input class="col-5 p-1 mr-2 text-center" type="text" name="user" placeholder="usuario">
                            <input class="col-5 p-1 ml-2 text-center" type="password" name="pass" placeholder="contraseña">
                            <div class="col-1"></div>
                        </div>
                        <div class="row pb-3">
                            <div class="col-2"></div>
                            <input class="col-8 p-1 text-center" type="email" name="email" placeholder="email">
                            <div class="col-2"></div>
                        </div>
                        <div class="row pb-4 pt-4">
                            <div class="col-3"></div>
                            <input type="submit" name="btn" class="col-6 btn" value="Aceptar">
                            <div class="col-3"></div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </body>
</html>
