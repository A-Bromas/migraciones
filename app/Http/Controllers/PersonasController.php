<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class PersonasController extends Controller
{
    //
    public function crear(Request $req){

        $respuesta = ["status" => "msg"=> "" ];
        
        $datos = $req ->getContent();

        //VALIDAR EL JSON hola pepe

        $datos = json_decode($datos); //Se interpreta como objeto. Se puede pasar un parametro para que en su lugar lo devuelva como array.
        
        //VALIDAR LOS DATOS

        $persona = new Persona();

        $persona->nombre = $datos->nombre;
        $persona->dni = $datos->dni;
        $persona->telefono = $datos->telefono;
        $persona->direccion = $datos->direccion;

        if(isset($datos->email))
            $persona->email = $datos->email;

        //Escribir en la base de datos
        try{
            $persona->save();
            $respuesta['msg'] = "Persona guardada con id ".$persona->id;
        }catch(\Exception $e){
            $respuesta['status'] = 0
            $respuesta['msg'] = "Se ha producido un error: ".e->getMessage();

            
        }

       return response()->json($respuesta);
    
        

    }


    public function borrar($id){

        $respuesta = ["status" => "msg"=> "" ];

        $persona = Persona::find($id);

        if($persona){
            try{
                $persona->delete();
                $respuesta['msg'] = "Persona borrada ";
            }catch(\Exception $e){
                $respuesta['status'] = 0
                $respuesta['msg'] = "Se ha producido un error: ".e->getMessage();
    
                
            }

        }else{
            $respuesta["msg"] = "Persona no encontrada";
            $respuesta["Status"] = 0;
        }

        return response()->json($respuesta);
    }

    public function editar(Request $req,$id){

        $respuesta = ["status" => "msg"=> "" ];
        
        $datos = $req ->getContent();

        //VALIDAR EL JSON

        $datos = json_decode($datos); //Se interpreta como objeto. Se puede pasar un parametro para que en su lugar lo devuelva como array.
        
        //VALIDAR LOS DATOS

        $persona = Persona::find($id);

        if(isset($datos->nombre))
            $persona->nombre = $datos->nombre;

        if(isset($datos->dni))
            $persona->dni = $datos->dni;

        if(isset($datos->telefono))
            $persona->telefono = $datos->telefono;

        if(isset($datos->direccion))
             $persona->direccion = $datos->direccion;

        if(isset($datos->email))
            $persona->email = $datos->email;

        //Escribir en la base de datos
        try{
            $persona->save();
            $respuesta['msg'] = "Persona actualizada ";
        }catch(\Exception $e){
            $respuesta['status'] = 0
            $respuesta['msg'] = "Se ha producido un error: ".e->getMessage();

            
        }

       return response()->json($respuesta);
    
        

    }
}
