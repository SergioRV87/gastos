<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="js/jquery-2.1.4.js" ></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="{{asset('gastos/js/jquery-2.1.4.min.js')}}"></script>
        <script type="text/javascript" src="js/listaGastosUsuario.js" ></script>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <!--<link rel="stylesheet" href="css/estilos.css">-->
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css"> 
        
        <?php

        use App\Objetos\Usuario;

$idus = null;
        $tus = null;
        $ptotal = 0;
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
            $contenidoGp = "";
            $(document).ready(function () {
                //cargarInicio();
                cargaSelectGastos();
            });
            function cargarUsuario()
            {
                $idussel = document.getElementById("selusr").value;
                if ($idussel != -1) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {"usuario": $idussel},
                        url: 'ajax/cargaGastosUsuario.php',
                        type: 'post',
                        success: function (response) {
                            //Si en response viene la cadena vacio es que no hay nada en la  base de datos.
                            if (response == "vacio")
                            {
                                var tabla = '<h3>Sin gastos..</h3>';
                                document.getElementById("lista").innerHTML = tabla;
                                document.getElementById("detalle").innerHTML = "<h3>Seleccione un gasto de usuario...</h3>";
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
                                        tabla += '<div class="row mb-2"><div class="col-12"><button class="boton form-control" onclick="carga(' + imprimir[$i].id + ')" > <label>' + imprimir[$i].fecha + '|' + tipo(imprimir[$i].tipo) + '|' + imprimir[$i].cuantia + '€</label></button></div></div>';
                                    } else {
                                        tabla += '<div class="row mb-2"><div class="col-12"><button class="boton form-control" onclick="carga(' + imprimir[$i].id + ')" > <label>' + imprimir[$i].fecha + '|' + tipo(imprimir[$i].tipo) + '|' + imprimir[$i].km + 'km</label></button></div></div>';
                                    }
                                }
                                document.getElementById("lista").innerHTML = tabla;
                            }
                        }
                    });
                } else {
                    var tabla = '<h3>Sin gastos...</h3>';
                    document.getElementById("lista").innerHTML = tabla;
                    document.getElementById("detalle").innerHTML = "<h3>Seleccione un gasto de usuario...</h3>";
                }

            }
            ;
            function carga(id) {
                var tabla = "";
                for ($i = 0; $i < $contenido.length; $i++) {
                    if ($contenido[$i].id == id) {
                        if ($contenido[$i].tipo == 1 || $contenido[$i].tipo == 3) {
                            tabla = '<div class="row"><div class="col-8 text-right"><label>Fecha:' + $contenido[$i].fecha + '</label></div><div class="col-4"><button class="from-control btn btn-dark" onclick="aniadeAGp(' + $contenido[$i].id + ')">+</button></div></div>\n\
                        <div class="row"><div class="col-12"><label>Tipo:' + tipo($contenido[$i].tipo) + '</label></div></div><div class="row"><div class="col-12"><label>Cuantia:' + $contenido[$i].cuantia + '€</label></div></div><div class="row"><div class="col-12"><label>Descripcion:' + $contenido[$i].descripcion + '</label></div></div><div class="row"><div class="col-12"><image src="gimg/-' + $contenido[$i].id + '.jpg" class="img-responsive" style="max-width:50%;"></div></div></div>';
                        } else {
                            tabla = '<div class="row"><div class="col-8 text-right"><label>Fecha:' + $contenido[$i].fecha + '</label></div><div class="col-4"><button class="from-control btn btn-dark" onclick="aniadeAGp(' + $contenido[$i].id + ')">+</button></div></div>\n\
                        <div class="row"><div class="col-12"><label>Tipo:' + tipo($contenido[$i].tipo) + '</label></div></div><div class="row"><div class="col-12"><label>KM:' + $contenido[$i].cuantia + '</label></div></div><div class="row"><div class="col-12"><label>Descripcion:' + $contenido[$i].descripcion + '</label></div></div></div>';
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
            function cargaSelectGastos() {
                $.ajax({
                    data: {"usuario":<?php echo $idus ?>},
                    url: 'ajax/cargaGrupos.php',
                    type: 'post',
                    success: function (response) {
                        //Si en response viene la cadena vacio es que no hay nada en la  base de datos.
                        if (response === "vacio")
                        {
                            document.getElementById("divselgp").innerHTML = '<div class="input-group-prepend">\n\
                <label class="input-group-text">Grupo de Gasto</label>\n\
                </div>\n\
                <select class="custom-select" id="selgp" name="selgp">\n\
                <option value="-1">No hay grupos seleccionados</option></select>';
                        }
                        //Si hay resultados se pintan
                        else
                        {
                            var imprimir = JSON.parse(response);
                            var tabla = '<div class="input-group-prepend">\n\
                <label class="input-group-text">Grupo de Gasto</label>\n\
                </div><select class="custom-select" id="selgp" name="selgp" onchange="cargarGrupo()"><option value="-1">No hay grupos seleccionados</option>';
                            for ($i = 0; $i < imprimir.length; $i++)
                            {   //`denominacion`,`id_grupo`
                                tabla += '<option value="' + imprimir[$i].id_grupo + '">' + imprimir[$i].denominacion + '</option>';
                            }
                            var tabla = tabla + '</select>';
                            document.getElementById("divselgp").innerHTML = tabla;
                        }
                    }
                });
            }
            function aniadeGP() {
                if (document.getElementById("ngp").value != null && document.getElementById("ngp").value != "" && document.getElementById("pkm").value != null && document.getElementById("pkm").value != "") {
                    $.ajax({
                        data: {"usuario":<?php echo $idus ?>, "denominacion": document.getElementById("ngp").value, "pkm": document.getElementById("pkm").value},
                        url: 'ajax/aniadeGP.php',
                        type: 'post',
                        success: function (response) {
                            //Si en response viene la cadena vacio es que no hay nada en la  base de datos.
                            if (response === "insertado")
                            {
                                cargaSelectGastos();
                                alert("Grupo de gastos añadido");
                            }
                        }
                    });
                } else {
                    alert("Rellene la denominacion y el precio por kilometro para crear un nuevo grupo");
                }
            }
            function cargarGrupo() {
                $idussel = document.getElementById("selgp").value;
                $ptotal = 0;
                if ($idussel != -1) {
                    $.ajax({
                        data: {"usuario": $idussel},
                        url: 'ajax/cargaGrupo.php',
                        type: 'post',
                        success: function (response) {
                            //Si en response viene la cadena vacio es que no hay nada en la  base de datos.
                            if (response == "vacio")
                            {
                                var tabla = '<h3>Sin gastos..</h3>';
                                document.getElementById("listaGp").innerHTML = tabla;
                                document.getElementById("detalleGp").innerHTML = "<h3>Seleccione un gasto de usuario...</h3>";
                            }
                            //Si hay resultados se pintan
                            else
                            {

                                var imprimir = JSON.parse(response);
                                $contenidoGp = imprimir;
                                var tabla = '';
                                for ($i = 0; $i < imprimir.length; $i++)
                                {   //id,idus,descripcion,fecha,tipo,cuantia,km
                                    if (imprimir[$i].tipo == 1 || imprimir[$i].tipo == 3) {
                                        $ptotal += parseInt(imprimir[$i].cuantia);
                                        tabla += '<div class="row mb-2"><div class="col"><button class="boton form-control" onclick="cargaGGp(' + imprimir[$i].id + ')" > <label>' + imprimir[$i].user + '|' + imprimir[$i].fecha + '|' + tipo(imprimir[$i].tipo) + '|' + imprimir[$i].cuantia + '€</label></button></div></div>';
                                    } else {
                                        $ptotal += parseInt(imprimir[$i].km) * parseInt(imprimir[$i].pkm);
                                        tabla += '<div class="row mb-2"><div class="col"><button class="boton form-control" onclick="cargaGGp(' + imprimir[$i].id + ')" > <label>' + imprimir[$i].user + '|' + imprimir[$i].fecha + '|' + tipo(imprimir[$i].tipo) + '|' + imprimir[$i].km + 'km</label></button></div></div>';
                                    }
                                }

                                document.getElementById("lbllistagp").innerHTML = '<div class="row mb-4"><div class="col-12 text-center"><button class="form control">Coste total: ' + $ptotal + ' €</button></div></div>';
                                document.getElementById("listaGp").innerHTML = tabla;
                            }
                        }
                    });
                } else {

                    var tabla = '<h3>Sin gastos...</h3>';
                    document.getElementById("listaGp").innerHTML = tabla;
                    document.getElementById("detalleGp").innerHTML = "<h3>Seleccione un gasto de usuario...</h3>";
                }
            }
            function aniadeAGp(id) {

                $idg = id;
                $gp = document.getElementById("selgp").value;
                if ($gp != "-1" && $gp != null) {

                    $.ajax({
                        data: {"idgasto": $idg, "idgp": $gp},
                        url: 'ajax/aniadeAGrupo.php',
                        type: 'post',
                        success: function (response) {
                            //Si en response viene la cadena vacio es que no hay nada en la  base de datos.
                            if (response == "ok")
                            {
                                cargarGrupo();
                            }
                        }
                    });

                } else {
                    alert("Seleccione primero un grupo y luego pulse en añadir sobre el gasto.");
                }
            }
            function cargaGGp(id) {
                var tabla = "";
                for ($i = 0; $i < $contenidoGp.length; $i++) {
                    if ($contenidoGp[$i].id == id) {
                        if ($contenidoGp[$i].tipo == 1 || $contenidoGp[$i].tipo == 3) {
                            tabla = '<div class="row"><div class="col-8 text-right"><label>Fecha:' + $contenidoGp[$i].fecha + '</label></div><div class="col-4"><button class="btn btn-dark" onclick="borraDeGp(' + $contenidoGp[$i].id + ',' + $contenidoGp[$i].idg + ')">X</button></div></div>\n\
                            <div class="row"><div class="col-12"><label>Tipo:' + tipo($contenidoGp[$i].tipo) + '</label></div></div><div class="row"><div class="col-12"><label>Cuantia:' + $contenidoGp[$i].cuantia + '€</label></div></div><div class="row"><div class="col-12"><label>Descripcion:' + $contenidoGp[$i].descripcion + '</label></div></div><div class="row"><div class="col-12"><image src="gimg/-' + $contenidoGp[$i].id + '.jpg" class="img-responsive"></div></div></div>';
                        } else {
                            tabla = '<div class="row"><div class="col-8 text-right"><label>Fecha:' + $contenidoGp[$i].fecha + '</label></div><div class="col-4"><button class="btn btn-dark" onclick="borraDeGp(' + $contenidoGp[$i].id + ',' + $contenidoGp[$i].idg + ')">X</button></div></div>\n\
                            <div class="row"><div class="col-12"><label>Tipo:' + tipo($contenidoGp[$i].tipo) + '</label></div></div><div class="row"><div class="col-12"><label>KM:' + $contenidoGp[$i].cuantia + '</label></div></div><div class="row"><div class="col-12"><label>Descripcion:' + $contenidoGp[$i].descripcion + '</label></div></div></div>';
                        }
                        $i = $contenidoGp.length;
                    }
                }
                document.getElementById("detalleGp").innerHTML = tabla;
            }
            ;
            function borraDeGp(idga, idgr) {
                $idga = idga;
                $idgr = idgr;
                $.ajax({
                    data: {"idgasto": $idga, "idgrupo": $idgr},
                    url: 'ajax/borraDeGP.php',
                    type: 'post',
                    success: function (response) {
                        //Si en response viene la cadena vacio es que no hay nada en la  base de datos.
                        if (response == "ok")
                        {
                            cargarGrupo();
                            document.getElementById("detalleGp").innerHTML = "<h3>Seleccione un gasto de usuario...</h3>";
                        }
                    }
                });
            }
            ;
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
        <div class="row">
            <div class="col-12">
                <div class="row mt-4">
                    <div class="col-lg-4 col-md-0 col-0"></div>
                    <div class="col-lg-4 col-md-12 col-12">
                        <div class="input-group" id="divselgp" name="divselgp">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-0 col-0"></div>
                </div>
                <div class="row mb-4 mt-lg-3 mt-2">
                    <div class="col-lg-2 col-md-0 col-0"></div>
                    <div class="input-group col-lg-4 col-md-12 col-12 mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Denominación</span>
                        </div>
                        <input class="form-control" type="text" name="ngp" id="ngp">
                    </div>
                    <div class="input-group col-lg-3 col-md-12 col-12 mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Precio por km</span>
                        </div>
                        <input class="form-control" type="number" name="pkm" id="pkm">
                    </div>
                    <div class="col-lg-1 col-md-12 col-12 mb-2">
                        <input type="button" onclick="aniadeGP()" value="Añadir" class="btn btn-dark col">
                    </div>
                    <div class="col-lg-1 col-md-0 col-0"></div>
                </div>
                <div id="accordion1" class="mt-4">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-toolbar collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Usuarios
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion1">
                            <div class="card-body">
                                <div class="row mt-4">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4">
                                        <div class="input-group" name="divusuarios" id="divusuarios" >
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="id_tipo_dieta">Usuario</label>
                                            </div>
                                            <select class="custom-select" id="selusr" name="selusr" onchange="cargarUsuario()">
                                                <?php foreach ($usuarios as $usuario) {
                                                    ?>
                                                    <option value="<?php echo $usuario->id ?>"><?php echo $usuario->user . " | " . $usuario->nombre . " | " . $usuario->apellidos ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4"></div>
                                </div>
                                <div class="row mt-4 mb-4">
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-5 col-md-12 col-sm-12">
                                        <div class="menu card">
                                            <div class="itemm card-header" id='ctrs'>
                                                <h5 class="mb-0 row ml-lg-1">
                                                    <button class="form-control col-lg-10 offset-lg-1">
                                                        Lista de gastos del usuario
                                                    </button>
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
                                                        Detalle del gasto del usuario
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="detalle" name="detalle" class="smenuu card-body text-center mb-2">
                                                <label>Selecciona un gasto para verlo en detalle</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="accordion2" class="mb-4">
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-toolbar collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Grupos de gasto
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion2">
                            <div class="card-body">
                                <div class="row mt-4 mb-4">
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-5 col-md-12 col-sm-12">
                                        <div class="menu card">
                                            <div class="itemm card-header" id='ctrs'>
                                                <h5 class="mb-0 row ml-lg-1">
                                                    <button class="form-control col-lg-10 offset-lg-1">
                                                        Lista de gastos del grupo
                                                    </button>
                                                </h5>
                                            </div>
                                            <div class="smenuu card-body">
                                                <div id="lbllistagp"></div>
                                                <div id="listaGp" name="listaGp">
                                                    <h3>Cargando....</h3>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-12 col-sm-12">
                                        <div class="menu card">
                                            <div class="itemm card-header" id='ctrs'>
                                                <h5 class="mb-0 row">
                                                    <button class="form-control col-lg-10 offset-lg-1">
                                                        Detalle del gasto del grupo
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="detalleGp" name="detalleGp" class="smenuu card-body text-center mb-2">
                                                <label>Selecciona un gasto para verlo en detalle</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>@include('footer')</div>
    </body>
</html>