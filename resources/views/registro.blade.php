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
        <div class="row mt-3">
            <div class="col-3"></div>
            <div class="col-6 p-5 cajaIndex">
                <div class="row pb-4">
                    <label class="col-12 text-left">¿ya tiene una cuenta? <a class="text-left" href="index">Iniciar sesión</a></label>
                </div>
                <form name="registro" class="row" method="POST">
                    <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                    <div class="col-12">
                        <div class="row pb-3">  
                            <div class="col-1"></div>
                            <input class="col-5 p-1 mr-2 text-center campo" type="text" id="nombre" name="nombre" placeholder="nombre" required>
                            <input class="col-5 p-1 ml-2 text-center campo" type="text" id="apellidos" name="apellidos" placeholder="apellidos" required>
                            <div class="col-1"></div>
                        </div>
                        <div class="row pb-3">
                            <div class="col-1"></div>
                            <input class="col-5 p-1 mr-2 text-center campo" type="text" id="user" name="user" placeholder="nombre de usuario" required>
                            <input class="col-5 p-1 ml-2 text-center campo" type="password" id="pass" name="pass" placeholder="contraseña" required>
                            <div class="col-1"></div>
                        </div>
                        <div class="row pb-3">
                            <div class="col-2"></div>
                            <input class="col-8 p-1 text-center campo" type="email" id="email" name="email" placeholder="email" required=>
                            <div class="col-2"></div>
                        </div>
                        <div class="row pb-4 pt-4">
                            <div class="col-3"></div>
                            <input type="submit" id="registrar" class="col-6 btn" value="Aceptar">
                            <div class="col-3"></div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="col-3"></div>
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
                        <h4 class="modal-title">Warning</h4>
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
