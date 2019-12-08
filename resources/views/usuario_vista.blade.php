<!doctype html>
<html lang="{{ app()->getLocale() }}">
     <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="js/jquery-2.1.4.js" ></script>
        <script src="js/bootstrap.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/estilos.css">
        <script type="text/javascript" src="js/listaGastosUsuario.js" ></script>
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css"> 
        <script src="{{asset('gastos/js/jquery-2.1.4.min.js')}}"></script>
        <?php 
        use App\Objetos\Usuario;
        
        $idus=null;
        if(\Session::has('usuario')){
            $usr=new Usuario("", "", "", "","","");
            $usr=\Session::get('usuario');
            $idus= $usr->getId();
        }
        ?>
    </head>
    <body>
        <script>
            $contenido="";
            $( document ).ready(function() {
                cargarInicio();
            });
            function cargarInicio()
            {

                $.ajax({
                    data:{"usuario":"<?php echo$idus ?>"},
                    url: 'ajax/cargaGastosUsuario.php',
                    type: 'post',
                    success: function (response) {
                        //Si en response viene la cadena vacio es que no hay nada en la  base de datos.
                        if(response=="vacio")
                        {
                            alert("vacio");
                            var tabla = '<h1>Sin gastos..</h1>';
                            document.getElementById("lista").innerHTML= tabla;
                        }
                        //Si hay resultados se pintan
                        else
                        {
                            var imprimir = JSON.parse(response);
                            $contenido=imprimir;
                            var tabla = '';
                            for($i=0; $i < imprimir.length; $i++)
                            {   //id,idus,descripcion,fecha,tipo,cuantia,km
                                if(imprimir[$i].tipo==1 || imprimir[$i].tipo==3){
                                    tabla += '<div class="row"><div class="col"><button class="boton form-control" onclick="carga('+imprimir[$i].id+')" > <label>'+imprimir[$i].fecha+'|'+tipo(imprimir[$i].tipo)+'|'+imprimir[$i].cuantia+'€</label></button></div></div>';
                                }else{
                                    tabla += '<div class="row"><div class="col"><button class="boton form-control" onclick="carga('+imprimir[$i].id+')" > <label>'+imprimir[$i].fecha+'|'+tipo(imprimir[$i].tipo)+'|'+imprimir[$i].km+'km</label></button></div></div>';
                                }
                            }
                            document.getElementById("lista").innerHTML= tabla;
                        }
                    } 
                });
            };
            function carga(id){
                var tabla="";
                for($i=0; $i < $contenido.length; $i++){  
                    if($contenido[$i].id == id){
                        if($contenido[$i].tipo==1||$contenido[$i].tipo==3){
                            tabla = '<div class="row"><div class="col-12"><label>Fecha:'+$contenido[$i].fecha+'</label></div></div><div class="row"><div class="col-12"><label>Tipo:'+tipo($contenido[$i].tipo)+'</label></div></div><div class="row"><div class="col-12"><label>Cuantia:'+$contenido[$i].cuantia+'€</label></div></div><div class="row"><div class="col-12"><label>'+$contenido[$i].descripcion+'</label></div></div><div class="row"><div class="col-12"><image src="gimg/-'+$contenido[$i].id+'.jpg"></div></div></div>';
                        }else{
                            tabla = '<div class="row"><div class="col-12"><label>Fecha:'+$contenido[$i].fecha+'</label></div></div><div class="row"><div class="col-12"><label>Tipo:'+tipo($contenido[$i].tipo)+'</label></div></div><div class="row"><div class="col-12"><label>KM:'+$contenido[$i].cuantia+'</label></div></div><div class="row"><div class="col-12"><label>'+$contenido[$i].descripcion+'</label></div></div></div>';
                        }
                        $i=$contenido.length;
                    }
                }
                document.getElementById("detalle").innerHTML= tabla;
            
            };
            function tipo(tip)
            {
                var ret="";
                switch (tip){
                    case "1": ret="Comida";
                        break;
                    case "3": ret="Tranporte publico";
                        break;
                    case "4": ret="Transporte personal";
                        break;
                }
                return ret;
            }
        </script>
        <div class="container-fluid">
            <!--Titulo-->
            <div class="row border-bottom cabecera">
                <div class="col-12 text-center">
                    <h1>Gastos</h1>
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
                <div class="col-6 text-left">
                    <form name="formulario" action="cierra_sesion" method="POST">
                        {!! csrf_field(); !!}
                        <input class="boton form-control" type="submit" id="cs" name="cs" value="Cerrar sesion">
                    </form>
                    <!--<input class="boton" type="button" name="guardar" id="nuevo" value="Nuevo gasto" onclick="nuevo()">-->
                </div>
                <div class="col-6 text-right">
                    <form name="formulario" action="nuevo_gasto_apertura" method="POST">
                        {!! csrf_field(); !!}
                        <input class="boton form-control" type="submit" id="nuevo" name="nuevo" value="Nuevo Gasto">
                    </form>
                    <!--<input class="boton" type="button" name="guardar" id="nuevo" value="Nuevo gasto" onclick="nuevo()">-->
                </div>
            </div>
            <!--Asignacion de criterios-->
            <div class="row border-bottom">
                <!--CE-->
                <div class="col-lg-4 col-md-12 col-sm-12 text-center" name="ce" id="ce" >
                    <div class="middle">
                        <div class="menu">
                            <li class="itemm" id='ctrs'>
                            <a href="#profile" class="btn"><i class="far fa-user"></i>Lista</a>
                                <div id="lista" name="lista" class="smenuu">
                                    <h1>Cargando....</h1>
                                </div>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 text-center">
                    <div class="middle">
                        <div class="menu">
                            <li class="itemm" id='ctrs'>
                            <a href="#profile" class="btn"><i class="far fa-user"></i>Detalle</a>
                                <div id="detalle" name="detalle" class="smenuu">
                                    <label>Selecciona un gasto para verlo en detalle</label>
                                </div>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>