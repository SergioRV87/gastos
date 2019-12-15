<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="js/jquery-2.1.4.js" ></script>
        <script src="js/bootstrap.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <!--        <link rel="stylesheet" href="css/estilos.css">-->

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <script>
            $(document).ready(function () {
                document.getElementById('id_tipo_transporte_l').style.visibility = 'hidden';
                document.getElementById('id_tipo_transporte').style.visibility = 'hidden';
                document.getElementById('km').style.visibility = 'hidden';
                document.getElementById('km_l').style.visibility = 'hidden';
            });

            function dieta_change()
            {
                if (parseInt(document.getElementById('id_tipo_dieta').value) == 1) {
                    document.getElementById('id_tipo_transporte_l').style.visibility = 'hidden';
                    document.getElementById('id_tipo_transporte').style.visibility = 'hidden';

                } else {
                    document.getElementById('id_tipo_transporte').style.visibility = 'visible';
                    document.getElementById('id_tipo_transporte_l').style.visibility = 'visible';
                }
                document.getElementById('id_tipo_transporte').value = 3;
                transporte_change();
            }
            function transporte_change()
            {
                if (parseInt(document.getElementById('id_tipo_transporte').value) == 3) {
                    document.getElementById('km').style.visibility = 'hidden';
                    document.getElementById('km_l').style.visibility = 'hidden';
                    document.getElementById('cuantia_l').style.visibility = 'visible';
                    document.getElementById('cuantia').style.visibility = 'visible';
                    document.getElementById('fichero_usuario').style.visibility = 'visible';
                    document.getElementById('fichero_usuario_l').style.visibility = 'visible';
                    $('#fichero_usuario').prop("required", true);
                } else {

                    document.getElementById('km').style.visibility = 'visible';
                    document.getElementById('km_l').style.visibility = 'visible';
                    document.getElementById('cuantia_l').style.visibility = 'hidden';
                    document.getElementById('cuantia').style.visibility = 'hidden';
                    document.getElementById('fichero_usuario').style.visibility = 'hidden';
                    document.getElementById('fichero_usuario_l').style.visibility = 'hidden';
                    $('#fichero_usuario').removeAttr("required");
                }
            }
        </script>
        <?php

        use App\Objetos\Usuario;

$idus = null;
        $tus = null;
        if (\Session::has('usuario')) {
            $usr = new Usuario("", "", "", "", "", "");
            $usr = \Session::get('usuario');
            $idus = $usr->getId();
            $tus = $usr->getRol();
        }
        ?>
    </head>
    <body class="container-fluid" style="background-color: #8bacc1">
        <div class="row p-2 badge-dark">
            <div class="btn-toolbar col-xl-11 col-lg-11 col-sm-11 col-xs-11" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group row" role="group" aria-label="First group">
                    <form  class="col-5" name="formulario" action="usuario_vista" method="GET">
                        {!! csrf_field(); !!}
                        <input class="btn btn-info" type="submit" id="usuario_vista" name="" value="Tus Gastos">
                    </form>
                    <?php if ($tus == "administrador") { ?> 
                        <form  class="col-6 ml-1" name="formulario" action="administracion_vista" method="POST">
                            {!! csrf_field(); !!}
                            <input class="btn btn-info" type="submit" id="adminbtn" name="adminbtn" value="Administración">
                        </form>  
                    <?php } ?>
                </div>
            </div>
            <div class="btn-toolbar col-xl-1 col-lg-1 col-sm-1 col-xs-1" role="toolbar" aria-label="Toolbar with button groups">
                <div class="row btn-group" role="group" aria-label="First group">
                    <form  class="col-12" name="formulario" action="cierra_sesion" method="GET">
                        <input class="btn btn-danger" type="submit" id="salir" name="salir" value="Salir">
                    </form>
                </div>
            </div>
        </div>
        <!--Creacion gasto-->
        <div class="row mt-5 p-4">
            <div class="col-12 text-center">
                <form name="formulario" enctype="multipart/form-data" action="nuevo_gasto_guardado" method="POST">
                    {!! csrf_field(); !!}
                    <div class="row mb-lg-4">
                        <div class="col-lg-4 co-md-4 col-12 mb-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="id_tipo_dieta">Tipo de dieta</label>
                                </div>
                                <select id="id_tipo_dieta" name="id_tipo_dieta" class="custom-select" onchange="dieta_change()">
                                    <?php foreach ($tipoD as $i => $tipo) { ?> 
                                        <option value="<?php echo $tipo->id ?>">
                                            <?php echo $tipo->denominacion_dieta ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-12 mb-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="id_tipo_transporte" id="id_tipo_transporte_l">Tipo de transporte</label>
                                </div>
                                <select id="id_tipo_transporte" name="id_tipo_transporte" class="custom-select" onchange="transporte_change()">
                                    <?php foreach ($tipoT as $i => $tipo) { ?> 
                                        <option value="<?php echo $tipo->id ?>">
                                            <?php echo $tipo->denominacion_transporte ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-12 mb-2">
                            <div class="input-group">
                                <input type="number" id="km" name="km" min="1" value="1" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="km_l">Kms</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-4 col-md-12 col-12 mb-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="fecha_l">Fecha</span>
                                </div>
                                <input type="date" name="fecha" class="form-control" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-12 mb-2">
                            <div class="input-group" id="fichero_usuario_l">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Foto tiquet</span>
                                </div>
                                <div class="custom-file">
                                    <input id="fichero_usuario" name="fichero_usuario" type="file" accept=".jpg" required class="custom-file-input">
                                    <label class="custom-file-label">archivo</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-12 mb-lg-2 mb-md-0 mb-0">
                            <div class="input-group" id="cuantia_l">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Cuantía</span>
                                </div>
                                <input class="form-control" type="number" id="cuantia" name="cuantia" min="1" value="1">
                                <div class="input-group-append">
                                    <span class="input-group-text">€</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-lg-2 col-0"></div>
                        <div class="col-lg-8 col-12 mb-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Descripción</span>
                                </div>
                                <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-2 col-0"></div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-lg-4 col-md-2 col-2">
                        </div>
                        <div class="col-lg-4 col-md-8 col-8">
                            <input class="form-control boton btn-dark" type="submit" value="Guardar">
                        </div>
                        <div class="col-lg-4 col-md-2 col-2">
                        </div>
                    </div>
                </form>
                <div class="row mb-5">
                    <div class="col-lg-5 col-md-3 col-3">
                    </div>
                    <div class="col-lg-2 col-md-6 col-6">
                        <form name="formulario" action="usuario_vista" method="GET">
                            <input class="form-control boton btn-danger" type="submit" value="Cancelar">
                        </form>
                    </div>
                    <div class="col-lg-5 col-md-3 col-3">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5"> @include('footer')</div>
    </body>
</html>
