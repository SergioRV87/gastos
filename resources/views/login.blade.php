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
                <form class="row mt-5" name="login" method="POST">
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-1 col-1"></div>
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-10 col-10">
                        <div class="row">
                            <input type="text" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 form-control text-center" id="user" name="usuario" value="" placeholder="Usuario" required>
                        </div>
                        <div class="row mt-2">
                            <input type="password" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 form-control text-center" id="pass" name="pass" value="" placeholder="Contraseña" required>
                        </div>
                        <div class="row mt-5">
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3"></div>
                            <input type="submit" id="login" class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 btn" value="Aceptar">
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3"></div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-1 col-1"></div>
                </form>
                <div class="row mt-3 mb-5">
                    <div class="col-xl-4 col-lg-4 col-md-2 col-sm-1 col-1"></div>
                    <a class="col-xl-4 col-lg-4 col-md-8 col-sm-10 col-10 text-center text-primary" href="nuevoregistro">Resgístrese</a>
                    <div class="col-xl-4 col-lg-4 col-md-2 col-sm-1 col-1"></div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-2 col-sm-1 col-1"></div>
        </div>
        <!-- The Modal -->
        <div class="modal" id="myModalWarning">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header badge-warning">
                        <h4 class="modal-title">Cuidado</h4>
                    </div>
                    <!-- Modal body -->
                    <div id="contenido" class="modal-body badge-warning">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
