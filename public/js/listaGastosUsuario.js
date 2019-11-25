/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function cargarInicio()
{
    $.ajax({
        data:{"funcion":"inicio"},
        url: 'ajax/cargaInicio.php',
        type: 'post',
        success: function (response) {
            //Si en response viene la cadena vacio es que no hay nada en la tabla articulos de la base de datos.
            if(response=="vacio")
            {
                var tabla = '<h1>Almacen vacio, buscando burros...</h1>';
                document.getElementById("contenido").innerHTML= tabla;
            }
            //Si hay articulos se pintan
            else
            {
                var imprimir = JSON.parse(response);
                var tabla = '';
                for($i=0; $i < imprimir.length; $i++)
                {                       
                    tabla += '<div class="col-4 border-dark"> <label>'+imprimir[$i].nombre+'</label> <br> <image src="img/'+imprimir[$i].id+'.png" style="height: 100px"><br> <label>'+imprimir[$i].descripcion+'</label><br><label>'+imprimir[$i].precio+'€</label><br><button onclick="aniade('+imprimir[$i].id+','+imprimir[$i].precio+',`'+imprimir[$i].nombre+'`,'+0+')">Añadir</button></div>';
                }
                document.getElementById("contenido").innerHTML= tabla;
            }
        } 
    });
};