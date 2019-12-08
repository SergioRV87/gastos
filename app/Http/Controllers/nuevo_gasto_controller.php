<?php

namespace App\Http\Controllers;
use App\Objetos\Usuario;
use Illuminate\Http\Request;
use DB;

class nuevo_gasto_controller extends Controller
{
    //
    public function show() {
       $td = DB::select('select id, denominacion_dieta from tipo_dieta order by id');
       //var_dump($td);
       $tt = DB::select('select id, denominacion_transporte from tipo_transporte order by id');
       //var_dump($tt);

       $datos=[
                'tipoD' => $td,
                'tipoT' => $tt
            ];
        return view('nuevo_gasto_vista',$datos);
    }
  
    public function nuevo_gasto_guardado(Request $req){
    
        if(\Session::has('usuario')){
            $usr=new Usuario("", "", "", "","","");
            $usr=\Session::get('usuario');
            $idus= $usr->getId();
            $usuario= $usr->getUsuario();
            $nombre= $usr->getNombre();
            $apellidos= $usr->getApellidos();
            $email= $usr->getEmail();
            $rol= $usr->getRol();
        }
        
        $td=$req->get('id_tipo_dieta');
        $tt=$req->get('id_tipo_transporte');
        $km=$req->get('km');
        $fecha=$req->get('fecha');
        $cuantia=$req->get('cuantia');
        $descripcion=$req->get('descripcion');
        $msg="";
        $corr=false;
        
        if($descripcion==null)
        {
            $descripcion="";
        }
        //Seleccionamos el max id de los gastos para saber cual fue el ultimo
        $idg = DB::select("SELECT max(`id`) as 'maxid' FROM `gastos`");
        //Comprobamos que no sea null, si lo es, significa que es el primer gasto a almacenar.
        if($idg[0]->maxid!=null){
            $idg = ($idg[0]->maxid)+1;
        } else{
            $idg=1;
        }
        //Comprobamos que todos los campos necesarios segun la eleccion esten rellenos.
        if($td == "1"){
            if($cuantia != null){
                if(\DB::table('gastos')->insert(['id' => $idg, 'id_usuario' => $idus, 'descripcion' => $descripcion, 'fecha' => $fecha, 'tipo' => $td]) && \DB::table('c_com_pub')->insert(['id_gasto' => $idg, 'cuantia' => $cuantia])){
                    $corr=true;
                }
            }
        }else{
            if($tt == "3"){
                if(\DB::table('gastos')->insert(['id' => $idg, 'id_usuario' => $idus, 'descripcion' => $descripcion, 'fecha' => $fecha, 'tipo' => $tt]) && \DB::table('c_com_pub')->insert(['id_gasto' => $idg, 'cuantia' => $cuantia])){
                    $corr=true;
                }
            }else{
                if(\DB::table('gastos')->insert(['id' => $idg, 'id_usuario' => $idus, 'descripcion' => $descripcion, 'fecha' => $fecha, 'tipo' => $tt]) && \DB::table('transporte_personal')->insert(['id_gasto' => $idg, 'km' => $km])){
                    $corr=true;
                }
            }
        }
        
        //Si el gasto se a guardado en base de datos correctamente se sube la imagen
        if($corr)
        {
            //Sube la imagen
            $msg="";
            $dir_subida = 'C:\xampp\htdocs\gastos\public\gimg\-';
            $fichero_subido = $dir_subida . $idg .".jpg";
            //basename($_FILES['fichero_usuario']['name']);
            //basename($_FILES['fichero_usuario']['tmp_name']);
            if ($_FILES["fichero_usuario"]["error"] > 0) {
                $_FILES["fichero_usuario"]["error"];
                $msg="Error subiendo la imagen";
            } 
            else 
            {
                move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido);

            }
            $msg='Usuario registrado.';
        }
        return view('usuario_vista');
        
    }

}
