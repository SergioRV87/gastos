<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="js/jquery-2.1.4.js" ></script>
        <script src="js/bootstrap.min.js"></script>
        <!--        <link rel="stylesheet" href="css/estilos.css">-->
        <script type="text/javascript" src="js/listaGastosUsuario.js" ></script>
        <script src="{{asset('gastos/js/jquery-2.1.4.min.js')}}"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css"> 

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
        <script>
            $contenido = "";
            $(document).ready(function () {
                cargarInicio();
            });
            function cargarInicio()
            {
                $.ajax({
                    data: {"usuario": "<?php echo $idus ?>"},
                    url: 'ajax/cargaGastosUsuario.php',
                    type: 'post',
                    success: function (response) {
                        //Si en response viene la cadena vacio es que no hay nada en la  base de datos.
                        if (response == "vacio")
                        {
                            var tabla = '<h3>Sin gastos..</h3>';
                            document.getElementById("lista").innerHTML = tabla;
                        }
                        //Si hay resultados se pintan
                        else
                        {
                            var imprimir = JSON.parse(response);
                            $contenido = imprimir;
                            var tabla = '';
                            for ($i = 0; $i < imprimir.length; $i++)
                            {   //id,idus,descripcion,fecha,tipo,cuantia,km
                                if (imprimir[$i].tipo == 1 || imprimir[$i].tipo == 3) {
                                    tabla += '<div class="row mb-2"><div class="col"><button class="boton form-control" onclick="carga(' + imprimir[$i].id + ')" > <label>' + imprimir[$i].fecha + '|' + tipo(imprimir[$i].tipo) + '|' + imprimir[$i].cuantia + '€</label></button></div></div>';
                                } else {
                                    tabla += '<div class="row mb-2"><div class="col"><button class="boton form-control" onclick="carga(' + imprimir[$i].id + ')" > <label>' + imprimir[$i].fecha + '|' + tipo(imprimir[$i].tipo) + '|' + imprimir[$i].km + 'km</label></button></div></div>';
                                }
                            }
                            document.getElementById("lista").innerHTML = tabla;
                        }
                    }
                });
            }
            ;
            function carga(id) {
                var tabla = "";
                for ($i = 0; $i < $contenido.length; $i++) {
                    if ($contenido[$i].id == id) {
                        if ($contenido[$i].tipo == 1 || $contenido[$i].tipo == 3) {
                            tabla = '<div class="row"><div class="col-12"><label>Fecha:' + $contenido[$i].fecha + '</label></div></div><div class="row"><div class="col-12"><label>Tipo:' + tipo($contenido[$i].tipo) + '</label></div></div><div class="row"><div class="col-12"><label>Cuantia:' + $contenido[$i].cuantia + '€</label></div></div><div class="row"><div class="col-12"><label>' + $contenido[$i].descripcion + '</label></div></div><div class="row"><div class="col-12"><image src="gimg/-' + $contenido[$i].id + '.jpg"></div></div></div>';
                        } else {
                            tabla = '<div class="row"><div class="col-12"><label>Fecha:' + $contenido[$i].fecha + '</label></div></div><div class="row"><div class="col-12"><label>Tipo:' + tipo($contenido[$i].tipo) + '</label></div></div><div class="row"><div class="col-12"><label>KM:' + $contenido[$i].cuantia + '</label></div></div><div class="row"><div class="col-12"><label>' + $contenido[$i].descripcion + '</label></div></div></div>';
                        }
                        $i = $contenido.length;
                    }
                }
                document.getElementById("detalle").innerHTML = tabla;
            }
            ;
            function tipo(tip)
            {
                var ret = "";
                switch (tip) {
                    case "1":
                        ret = "Comida";
                        break;
                    case "3":
                        ret = "Tranporte publico";
                        break;
                    case "4":
                        ret = "Transporte personal";
                        break;
                }
                return ret;
            }
        </script>
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
        <div class="row mt-5">
            <div class="col-lg-1 col-sm-0"></div>
            <div class="col-lg-5 col-md-12 col-sm-12">
                <div class="menu card">
                    <div class="itemm card-header" id='ctrs'>
                        <h5 class="mb-0 row ml-lg-1">
                            <button class="form-control col-lg-10 col-sm-10 col-xs-2">
                                Lista
                            </button>
                            <form class="col-lg-2 col-sm-2 col-xs-2" name="formulario" action="nuevo_gasto_apertura" method="POST">
                                {!! csrf_field(); !!}
                                <input class="form-control btn-dark" type="submit" id="nuevo" name="nuevo" value="+">
                            </form> 
                        </h5>
                    </div>
                    <div id="lista" name="lista" class="smenuu card-body">
                        <h3>Cargando....</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12">
                <div class="menu card">
                    <div class="itemm card-header" id='ctrs'>
                        <h5 class="mb-0 row">
                            <button class="form-control col-lg-10 offset-lg-1">
                                Detalle
                            </button>
                        </h5>
                    </div>
                    <div id="detalle" name="detalle" class="smenuu card-body text-center mb-2">
                        <label>Selecciona un gasto para verlo en detalle</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 col-sm-0"></div>
        </div>
        <div class="mt-5">@include('footer')</div>
    </body>
</html>