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

    </head>
    <body>
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
                <div class="col-12 text-right">
                    <input class="boton" type="button" name="guardar" id="nuevo" value="Nuevo gasto" onclick="guardar()">
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
                                <div id="criterios" name="criterios" class="smenuu" ondrop="drop(this, event)" ondragenter="return false" ondragover="return false">
                                    <!--Contenido a arrastrar-->
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
                                <div id="criterios" name="criterios" class="smenuu" ondrop="drop(this, event)" ondragenter="return false" ondragover="return false">
                                    <!--Contenido a arrastrar-->
                                </div>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-left">
                <div class="col-lg-12 col-md-12">
                    <input class="boton col-3" type="button" id="guardar" name="guardar" value="Volver" onclick="toIndex()">
                </div>
            </div>
        </div>
    </body>
</html>
