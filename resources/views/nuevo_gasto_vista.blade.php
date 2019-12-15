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
        <div class="header header-expand">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="usuario_vista">Tus Gastos</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php if ($tus == "administrador") { ?>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="administracion_vista">Administración<span class="sr-only">(current)</span></a>
                            </li>
                        </ul>
                    <?php } else {
                        ?><div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <?php }?>
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link btn badge-danger" href="cierra_sesion">Salir<span class="sr-only">(current)</span></a>
                            </li>
                        </ul>
                    </div>
            </nav>
            <div class="row m-1 badge-light">
                <div class="col-12 border-dark border-top border-bottom border-right border-left text-center">
                    <p>Espacio para banner</p>
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
        <div class="row mt-4"><div class="col-12">@include('footer')</div></div>
    </body>
</html>
