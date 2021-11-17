<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domicilio;

class DomicilioController extends Controller
{
    public function crear(Request $req){

        $respuesta = ["status" => 1,"msg"=> "" ];        
        $datos = $req ->getContent();

        //VALIDAR EL JSON hola pepe

        $datos = json_decode($datos); //Se interpreta como objeto. Se puede pasar un parametro para que en su lugar lo devuelva como array.
        
        //VALIDAR LOS DATOS

        $domicilio = new Domicilio();
        $domicilio->calle = $datos->calle;
        $domicilio->numero = $datos->numero;
        $domicilio->codigo_postal = $datos->codigo_postal;
    
        //Escribir en la base de datos
        try{
            $domicilio->save();
            $respuesta['msg'] = "Domicilio guardado con id ".$domicilio->id;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();

            
        }

       return response()->json($respuesta);
    
        

    }
    public function editar(Request $req,$id){

        $respuesta = ["status" => 1,"msg"=> "" ];
        
        $datos = $req ->getContent();

        //VALIDAR EL JSON

        $datos = json_decode($datos); //Se interpreta como objeto. Se puede pasar un parametro para que en su lugar lo devuelva como array.
        
        //VALIDAR LOS DATOS

        $domicilio = Domicilio::find($id);

        if(isset($datos->calle))
            $domicilio->calle = $datos->calle;

        if(isset($datos->numero))
            $domicilio->numero = $datos->numero;

        if(isset($datos->codigo_postal))
            $domicilio->codigo_postal = $datos->codigo_postal;

       

        //Escribir en la base de datos
        try{
            $domicilio->save();
            $respuesta['msg'] = "Domicilio actualizado ";
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
            
        }

       return response()->json($respuesta);
    
        

    }
    public function ver($id){

        $respuesta = ["status" => 1,"msg"=> "" ];
        try{
            $domicilio = Domicilio::find($id);
            $respuesta['datos'] = $domicilio;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();

            
        }

       return response()->json($respuesta);
    
    }

}
