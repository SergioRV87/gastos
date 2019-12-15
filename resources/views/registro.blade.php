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
        <script src="{{asset('js/validacionRegistro.js')}}" type="text/javascript"></script>
    </head>
    <body class="container-fluid badge-dark">
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-1 col-sm-1 col-1"></div>
            <div class="col-xl-8 col-lg-8 col-md-10 col-sm-10 col-10 mt-5 cajaIndex pt-4 pb-5">
                <div class="row">
                    <label class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-left">¿ya tiene una cuenta?<a class="text-primary text-left" href="index"> Iniciar sesión</a></label>
                </div>
                <form name="registro" class="row pt-3" method="POST">
                    <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                    <div class="col-12">
                        <div class="row mt-2">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="row justify-content-center">        
                                    <input class="col-xl-4 col-lg-4 col-md-8 col-sm-10 col-10 mb-3 form-control text-center" type="text" id="nombre" name="nombre" placeholder="nombre" required>
                                    <div class="col-xl-1 col-lg-1 col-md-0 col-sm-0 col-0"></div>
                                    <input class="col-xl-4 col-lg-4 col-md-8 col-sm-10 col-10 mb-3 form-control text-center" type="text" id="apellidos" name="apellidos" placeholder="apellidos" required>
                                </div>
                                <div class="row justify-content-center">
                                    <input class="col-xl-4 col-lg-4 col-md-18 col-sm-10 col-10 mb-3 form-control text-center" type="text" id="user" name="user" placeholder="nombre de usuario" required>
                                    <div class="col-xl-1 col-lg-1 col-md-0 col-sm-0 col-0"></div>
                                    <input class="col-xl-4 col-lg-4 col-md-10 col-sm-10 col-10 mb-3 form-control text-center" type="password" id="pass" name="pass" placeholder="contraseña" required>
                                </div>
                                <div class="row justify-content-center">
                                    <input class="col-xl-7 col-lg-7 col-md-8 col-sm-10 col-10 form-control text-center" type="email" id="email" name="email" placeholder="email" required>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-xl-4 col-lg-4 col-md-3 col-sm-2 col-2"></div>
                                    <input type="submit" id="registrar" class="col-xl-4 col-lg-4 col-md-6 col-sm-8 col-8 btn" value="Aceptar">
                                    <div class="col-xl-4 col-lg-4 col-md-3 col-sm-2 col-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-1 col-sm-1 col-1"></div>
        </div>
        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header badge-success">
                        <h4 class="modal-title">Información</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body badge-success">
                        <p>Registrado con éxito</p>
                    </div>
                </div>
            </div>
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
