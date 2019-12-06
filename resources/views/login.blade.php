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
        <div class="row mt-3">
            <div class="col-4"></div>
            <div class="col-4 p-5 cajaIndex">
                <form class="row p-4" name="login" method="POST">
                    <div class="col-2"></div>
                    <div class="form-group col-8 pt-4">
                        <div class="row">
                            <input type="text" class="col-12 form-control text-center campo" id="user" name="usuario" value="" placeholder="Usuario" required>
                        </div>
                        <div class="row pt-4">
                            <input type="password" class="col-12 form-control text-center campo" id="pass" name="pass" value="" placeholder="Contraseña" required>
                        </div>
                        <div class="row pt-4">
                            <input type="submit" id="login" class="col-12 btn" value="Aceptar">
                        </div>
                    </div>
                    <div class="col-2"></div>
                </form>
                <div class="row pt-4">
                    <div class="col-4"></div>
                    <a class="col-4 text-center text-primary" href="nuevoregistro">Resgístrese</a>
                    <div class="col-4"></div>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
    </body>
</html>
