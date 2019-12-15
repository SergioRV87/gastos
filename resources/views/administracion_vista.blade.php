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
        $tus=null;
        $ptotal=0;
        if(\Session::has('usuario')){
            $usr=new Usuario("", "", "", "","","");
            $usr=\Session::get('usuario');
            $idus= $usr->getId();
            $tus= $usr->getRol();
        }
        ?>
    </head>
    <body>
        <script>
            $contenido="";
            $contenidoGp="";
            $( document ).ready(function() {
                //cargarInicio();
                cargaSelectGastos();
            });
            function cargarUsuario()
            {
                $idussel=document.getElementById("selusr").value;
                //alert($idussel);
                if($idussel!=-1){
                    $.ajax({
                    data:{"usuario":$idussel},
                    url: 'ajax/cargaGastosUsuario.php',
                    type: 'post',
                    success: function (response) {
                        //Si en response viene la cadena vacio es que no hay nada en la  base de datos.
                        if(response=="vacio")
                        {
                            var tabla = '<h1>Sin gastos..</h1>';
                            document.getElementById("lista").innerHTML= tabla;
                            document.getElementById("detalle").innerHTML= "<h1>Seleccione un gasto de usuario...</h1>";
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
                                    tabla += '<div class="row"><div class="col-12"><button class="boton form-control" onclick="carga('+imprimir[$i].id+')" > <label>'+imprimir[$i].fecha+'|'+tipo(imprimir[$i].tipo)+'|'+imprimir[$i].cuantia+'€</label></button></div></div>';
                                }else{
                                    tabla += '<div class="row"><div class="col-12"><button class="boton form-control" onclick="carga('+imprimir[$i].id+')" > <label>'+imprimir[$i].fecha+'|'+tipo(imprimir[$i].tipo)+'|'+imprimir[$i].km+'km</label></button></div></div>';
                                }
                            }
                            document.getElementById("lista").innerHTML= tabla;
                        }
                    } 
                });
                }else{
                    var tabla = '<h1>Sin gastos...</h1>';
                    document.getElementById("lista").innerHTML= tabla;
                    document.getElementById("detalle").innerHTML= "<h1>Seleccione un gasto de usuario...</h1>";
                }
                
            };
            function carga(id){
                var tabla="";
                for($i=0; $i < $contenido.length; $i++){  
                    if($contenido[$i].id == id){
                        if($contenido[$i].tipo==1||$contenido[$i].tipo==3){
                            tabla = '<div class="row"><div class="col-12"><label>Fecha:'+$contenido[$i].fecha+'</label></div></div><div class="row"><div class="col-12"><label>Tipo:'+tipo($contenido[$i].tipo)+'</label></div></div><div class="row"><div class="col-12"><label>Cuantia:'+$contenido[$i].cuantia+'€</label></div></div><div class="row"><div class="col-12"><button class="boton form-control" onclick="aniadeAGp('+$contenido[$i].id+')"><label>Añadir a grupo.</label></button></div></div><div class="row"><div class="col-12"><label>Descripcion:'+$contenido[$i].descripcion+'</label></div></div><div class="row"><div class="col-12"><image src="gimg/-'+$contenido[$i].id+'.jpg"></div></div></div>';
                        }else{
                            tabla = '<div class="row"><div class="col-12"><label>Fecha:'+$contenido[$i].fecha+'</label></div></div><div class="row"><div class="col-12"><label>Tipo:'+tipo($contenido[$i].tipo)+'</label></div></div><div class="row"><div class="col-12"><label>KM:'+$contenido[$i].cuantia+'</label></div></div><div class="row"><div class="col-12"><button class="boton form-control" onclick="aniadeAGp('+$contenido[$i].id+')"><label>Añadir a grupo.</label></button></div></div><div class="row"><div class="col-12"><label>Descripcion:'+$contenido[$i].descripcion+'</label></div></div></div>';
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
            function cargaSelectGastos(){
                $.ajax({
                    data:{"usuario":<?php echo $idus ?>},
                    url: 'ajax/cargaGrupos.php',
                    type: 'post',
                    success: function (response) {
                        //Si en response viene la cadena vacio es que no hay nada en la  base de datos.
                        if(response==="vacio")
                        {
                            document.getElementById("divselgp").innerHTML= '<select id="selgp" name="selgp"><option value="-1">Seleccione un grupo</option></select>';
                        }
                        //Si hay resultados se pintan
                        else
                        {
                            var imprimir = JSON.parse(response);
                            var tabla = '<select id="selgp" name="selgp" onchange="cargarGrupo()"><option value="-1">Seleccione un grupo</option>';
                            for($i=0; $i < imprimir.length; $i++)
                            {   //`denominacion`,`id_grupo`
                                tabla += '<option value="'+imprimir[$i].id_grupo+'">'+imprimir[$i].denominacion+'</option>';
                            }
                            var tabla = tabla + '</select>';
                            document.getElementById("divselgp").innerHTML= tabla;
                        }
                    } 
                });
            }
            function aniadeGP(){
                if(document.getElementById("ngp").value!=null && document.getElementById("ngp").value!="" && document.getElementById("pkm").value!=null && document.getElementById("pkm").value!=""){
                    $.ajax({
                        data:{"usuario":<?php echo $idus ?>,"denominacion":document.getElementById("ngp").value,"pkm":document.getElementById("pkm").value},
                        url: 'ajax/aniadeGP.php',
                        type: 'post',
                        success: function (response) {
                            //Si en response viene la cadena vacio es que no hay nada en la  base de datos.
                            if(response==="insertado")
                            {
                                cargaSelectGastos();
                                alert("Grupo de gastos añadido");
                            }
                        } 
                    });
                }else{
                    alert("Rellene la denominacion y el precio por kilometro para crear un nuevo grupo.");
                }
            }
            function cargarGrupo(){
                $idussel=document.getElementById("selgp").value;
                $ptotal=0;
                if($idussel!=-1){
                    $.ajax({
                        data:{"usuario":$idussel},
                        url: 'ajax/cargaGrupo.php',
                        type: 'post',
                        success: function (response) {
                            //Si en response viene la cadena vacio es que no hay nada en la  base de datos.
                            if(response=="vacio")
                            {
                                var tabla = '<h1>Sin gastos..</h1>';
                                document.getElementById("listaGp").innerHTML= tabla;
                                document.getElementById("detalleGp").innerHTML= "<h1>Seleccione un gasto de usuario...</h1>";
                            }
                            //Si hay resultados se pintan
                            else
                            {

                                var imprimir = JSON.parse(response);
                                $contenidoGp=imprimir;
                                var tabla = '';
                                for($i=0; $i < imprimir.length; $i++)
                                {   //id,idus,descripcion,fecha,tipo,cuantia,km
                                    if(imprimir[$i].tipo==1 || imprimir[$i].tipo==3){
                                        $ptotal+= parseInt(imprimir[$i].cuantia);
                                        tabla += '<div class="row"><div class="col"><button class="boton form-control" onclick="cargaGGp('+imprimir[$i].id+')" > <label>'+imprimir[$i].user+'|'+imprimir[$i].fecha+'|'+tipo(imprimir[$i].tipo)+'|'+imprimir[$i].cuantia+'€</label></button></div></div>';
                                    }else{
                                        $ptotal+=parseInt(imprimir[$i].km)*parseInt(imprimir[$i].pkm);
                                        tabla += '<div class="row"><div class="col"><button class="boton form-control" onclick="cargaGGp('+imprimir[$i].id+')" > <label>'+imprimir[$i].user+'|'+imprimir[$i].fecha+'|'+tipo(imprimir[$i].tipo)+'|'+imprimir[$i].km+'km</label></button></div></div>';
                                    }
                                }
                                
                                document.getElementById("lbllistagp").innerHTML= "Coste total: " + $ptotal + "€";
                                document.getElementById("listaGp").innerHTML= tabla;
                            }
                        } 
                    });
                }else{

                    var tabla = '<h1>Sin gastos...</h1>';
                    document.getElementById("listaGp").innerHTML= tabla;
                    document.getElementById("detalleGp").innerHTML= "<h1>Seleccione un gasto de usuario...</h1>";
                }
            }
            function aniadeAGp(id){
                
                $idg = id;
                $gp = document.getElementById("selgp").value;
                if($gp!="-1" && $gp!=null){
                    $.ajax({
                        data:{"idgasto":$idg,"idgp":$gp},
                        url: 'ajax/aniadeAGrupo.php',
                        type: 'post',
                        success: function (response) {
                            //Si en response viene la cadena vacio es que no hay nada en la  base de datos.
                            if(response=="ok")
                            {
                                cargarGrupo();
                            }
                        } 
                    });
        
                } else {
                    alert("Seleccione primero un grupo y luego pulse en añadir sobre el gasto.");
                }
            }
            function cargaGGp(id){
                var tabla="";
                for($i=0; $i < $contenidoGp.length; $i++){  
                    if($contenidoGp[$i].id == id){
                        if($contenidoGp[$i].tipo==1||$contenidoGp[$i].tipo==3){
                            tabla = '<div class="row"><div class="col-12"><label>Fecha:'+$contenidoGp[$i].fecha+'</label></div></div><div class="row"><div class="col-12"><label>Tipo:'+tipo($contenidoGp[$i].tipo)+'</label></div></div><div class="row"><div class="col-12"><label>Cuantia:'+$contenidoGp[$i].cuantia+'€</label></div></div><div class="row"><div class="col-12"><button class="boton form-control" onclick="borraDeGp('+$contenidoGp[$i].id+','+$contenidoGp[$i].idg+')"><label>Quitar de grupo.</label></button></div></div><div class="row"><div class="col-12"><label>Descripcion:'+$contenidoGp[$i].descripcion+'</label></div></div><div class="row"><div class="col-12"><image src="gimg/-'+$contenidoGp[$i].id+'.jpg"></div></div></div>';
                        }else{
                            tabla = '<div class="row"><div class="col-12"><label>Fecha:'+$contenidoGp[$i].fecha+'</label></div></div><div class="row"><div class="col-12"><label>Tipo:'+tipo($contenidoGp[$i].tipo)+'</label></div></div><div class="row"><div class="col-12"><label>KM:'+$contenidoGp[$i].cuantia+'</label></div></div><div class="row"><div class="col-12"><button class="boton form-control" onclick="borraDeGp('+$contenidoGp[$i].id+','+$contenidoGp[$i].idg+')"><label>Quitar de grupo.</label></button></div></div><div class="row"><div class="col-12"><label>Descripcion:'+$contenidoGp[$i].descripcion+'</label></div></div></div>';
                        }
                        $i=$contenidoGp.length;
                    }
                }
                document.getElementById("detalleGp").innerHTML= tabla;
            };
            function borraDeGp(idga,idgr){
                $idga = idga;
                $idgr = idgr;
                $.ajax({
                    data:{"idgasto":$idga,"idgrupo":$idgr},
                    url: 'ajax/borraDeGP.php',
                    type: 'post',
                    success: function (response) {
                        alert(response);
                        //Si en response viene la cadena vacio es que no hay nada en la  base de datos.
                        if(response=="ok")
                        {
                            cargarGrupo();
                            document.getElementById("detalleGp").innerHTML= "<h1>Seleccione un gasto de usuario...</h1>";
                        }
                    } 
                });
            };
        </script>
        <div class="container-fluid">
            <!--Titulo-->
            <div class="row border-bottom cabecera">
                <div class="col-12 text-center">
                    <h1>Gastos administracion</h1>
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
                <div class="col-lg-6 col-md-12 col-sm-12 text-left">
                    <form name="formulario" action="cierra_sesion" method="POST">
                        {!! csrf_field(); !!}
                        <input class="boton form-control" type="submit" id="cs" name="cs" value="Cerrar sesion">
                    </form>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 text-left">
                    <form name="formulario" action="usuario_vista" method="GET">
                        {!! csrf_field(); !!}
                        <input class="boton form-control" type="submit" id="usrv" name="usrv" value="Vista usuario">
                    </form>              
                </div>
            </div>
            <!--Asignacion de criterios-->
            <div class="row border-bottom">
                <div class="col-lg-4 col-md-12 col-sm-12 text-center" name="divusuarios" id="divusuarios" >
                    <select id="selusr" name="selusr" onchange="cargarUsuario()">
                        <option value="-1">Selecciona un usuario.</option>
                        <?php foreach($usuarios as $usuario){
                            ?>
                        <option value="<?php echo $usuario->id ?>"><?php echo $usuario->user." | ".$usuario->nombre." | ".$usuario->apellidos  ?></option>
                            <?php
                        }?>
                    </select>
                </div>
            </div>
            <div class="row border-bottom">
                <!--CE-->
                <div class="col-lg-4 col-md-12 col-sm-12 text-center" name="ce" id="ce" >
                    <div class="middle">
                        <div class="menu">
                            <li class="itemm" id='ctrs'>
                            <a href="#profile" class="btn"><i class="far fa-user"></i>Lista de gastos del usuario</a>
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
                            <a href="#profile" class="btn"><i class="far fa-user"></i>Detalle del gasto del usuario</a>
                                <div id="detalle" name="detalle" class="smenuu">
                                    <label>Selecciona un gasto para verlo en detalle</label>
                                </div>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row border-bottom">
                <div class="col-lg-4 col-md-12 col-sm-12 text-center" id="divselgp" name="divselgp">
                     
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 text-center" id="divselgp" name="divselgp">
                    <label for="ngp">Crear grupo: Denominacion</label>
                    <input type="text" name="ngp" id="ngp">
                    <label for="pkm">Precio por km</label>
                    <input type="number" name="pkm" step="any" id="pkm">
                    <input type="button" onclick="aniadeGP()" value="Añadir" class="boton">
                </div>
            </div>
            <div class="row border-bottom">
                <!--CE-->
                <div class="col-lg-4 col-md-12 col-sm-12 text-center" name="ce" id="ce" >
                    <div class="middle">
                        <div class="menu">
                            <li class="itemm" id='ctrs'>
                            <a href="#profile" class="btn"><i class="far fa-user" id="lbllistagp"></i>Lista de gastos del grupo</a>
                                <div id="listaGp" name="listaGp" class="smenuu">
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
                            <a href="#profile" class="btn"><i class="far fa-user" ></i>Detalle del gasto del usuario</a>
                                <div id="detalleGp" name="detalleGp" class="smenuu">
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