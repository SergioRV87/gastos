<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="js/jquery-2.1.4.js" ></script>
        <script src="js/bootstrap.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/estilos.css">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <script>
            $( document ).ready(function() {
                document.getElementById('id_tipo_transporte_l').style.visibility = 'hidden';
                document.getElementById('id_tipo_transporte').style.visibility = 'hidden';
                document.getElementById('km').style.visibility = 'hidden';
                document.getElementById('km_l').style.visibility = 'hidden';
            });
           
            function dieta_change()
            {
                if ( parseInt(document.getElementById('id_tipo_dieta').value) == 1){
                    document.getElementById('id_tipo_transporte_l').style.visibility = 'hidden';
                    document.getElementById('id_tipo_transporte').style.visibility = 'hidden';
                    
                } else {
                    document.getElementById('id_tipo_transporte').style.visibility = 'visible';
                    document.getElementById('id_tipo_transporte_l').style.visibility = 'visible';
                }
                document.getElementById('id_tipo_transporte').value=3;
                transporte_change();
            }
            function transporte_change()
            {
                if ( parseInt(document.getElementById('id_tipo_transporte').value) == 3){
                    document.getElementById('km').style.visibility = 'hidden';
                    document.getElementById('km_l').style.visibility = 'hidden';
                    document.getElementById('cuantia_l').style.visibility = 'visible';
                    document.getElementById('cuantia').style.visibility = 'visible';
                    document.getElementById('fichero_usuario').style.visibility='visible';
                    document.getElementById('fichero_usuario_l').style.visibility='visible';
                    $('#fichero_usuario').prop("required", true);
                } else {

                    document.getElementById('km').style.visibility = 'visible';
                    document.getElementById('km_l').style.visibility = 'visible';
                    document.getElementById('cuantia_l').style.visibility = 'hidden';
                    document.getElementById('cuantia').style.visibility = 'hidden';
                    document.getElementById('fichero_usuario').style.visibility='hidden';
                    document.getElementById('fichero_usuario_l').style.visibility='hidden';
                    $('#fichero_usuario').removeAttr("required");
                }
            }
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <!--Titulo-->
            <div class="row border-bottom cabecera">
                <div class="col-12 text-center">
                    <h1>Nuevo Gasto</h1>
                </div>

            </div>
            <!--Migas de pan -->
            <div class="row text-center border-bottom border-top cabecera">
                <div class="col-12 text-center">
                    <h1>Migas de pan</h1>
                </div>
            </div>
            <!--Creacion gasto-->
            <div class="row text-center border-bottom border-top cabecera">
                <div class="col-12 text-center">
                    <form name="formulario" enctype="multipart/form-data" action="nuevo_gasto_guardado" method="POST">
                        {!! csrf_field(); !!}
                    <div class="row">
                        <div class="col-4">
                            <label for="id_tipo_dieta">Tipo de dieta.</label>
                            <select class="form-control" id="id_tipo_dieta" name="id_tipo_dieta" onchange="dieta_change()">
                                <?php foreach ($tipoD as $i => $tipo) { ?> 
                                    <option value="<?php echo $tipo->id ?>">
                                        <?php echo $tipo->denominacion_dieta ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="id_tipo_transporte" id="id_tipo_transporte_l">Tipo de transporte.</label>
                            <select class="form-control" id="id_tipo_transporte" name="id_tipo_transporte" onchange="transporte_change()">
                                <?php foreach ($tipoT as $i => $tipo) { ?> 
                                    <option value="<?php echo $tipo->id ?>">
                                        <?php echo $tipo->denominacion_transporte ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="km" id="km_l">Kms.</label>
                            <input class="form-control" type="number" id="km" name="km" min="1" value="1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="fecha" id="fecha_l">Fecha</label>
                                <input type="date" name="fecha" class="form-control"  value="<?php echo date("Y-m-d");?>"/>
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="fichero_usuario" id="fichero_usuario_l"> Foto tiquet: </label>
                             <input class="form-control" id="fichero_usuario" name="fichero_usuario" type="file" accept=".jpg" required/>
                        </div>
                        <div class="col-4">
                            <label for="cuantia" id="cuantia_l">Cuantia.</label>
                            <input class="form-control" type="number" step="any" id="cuantia" name="cuantia" min="1" value="1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="descripcion">Descripcion.</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" ></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            
                        </div>
                        <div class="col-4">
                            <input class="form-control boton" type="submit" value="Guardar">
                        </div>
                        <div class="col-4">
                        </div>
                    </div>
                    </form>
                    <div class="row">
                        <div class="col-4">
                            <form name="formulario" action="usuario_vista" method="GET">
                                <input class="form-control boton" type="submit" value="Volver">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </body>
</html>
