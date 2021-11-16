<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class PersonasController extends Controller
{
    //
    public function crear(Request $req){

        $respuesta = ["status" => 1,"msg"=> "" ];        
        $datos = $req ->getContent();

        //VALIDAR EL JSON hola pepe

        $datos = json_decode($datos); //Se interpreta como objeto. Se puede pasar un parametro para que en su lugar lo devuelva como array.
        
        //VALIDAR LOS DATOS

        $persona = new Persona();
        $persona->nombre = $datos->nombre;
        $persona->primer_apellido = $datos->primer_apellido;
        $persona->segundo_apellido = $datos->segundo_apellido;
        $persona->fecha_de_nacimiento = $datos->fecha_de_nacimiento;
        $persona->direccion = $datos->direccion;

        if(isset($datos->email))
            $persona->email = $datos->email;

        //Escribir en la base de datos
        try{
            $persona->save();
            $respuesta['msg'] = "Persona guardada con id ".$persona->id;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();

            
        }

       return response()->json($respuesta);
    
        

    }


    public function borrar($id){

        $respuesta = ["status" => 1,"msg"=> "" ];
        $persona = Persona::find($id);

        if($persona){
            try{
                $persona->delete();
                $respuesta['msg'] = "Persona borrada ";
            }catch(\Exception $e){
                $respuesta['status'] = 0;
                $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
    
                
            }

        }else{
            $respuesta["msg"] = "Persona no encontrada";
            $respuesta["Status"] = 0;
        }

        return response()->json($respuesta);
    }

    public function editar(Request $req,$id){

        $respuesta = ["status" => 1,"msg"=> "" ];
        
        $datos = $req ->getContent();

        //VALIDAR EL JSON

        $datos = json_decode($datos); //Se interpreta como objeto. Se puede pasar un parametro para que en su lugar lo devuelva como array.
        
        //VALIDAR LOS DATOS

        $persona = Persona::find($id);

        if(isset($datos->nombre))
            $persona->nombre = $datos->nombre;

        if(isset($datos->primer_apellido))
            $persona->primer_apellido = $datos->primer_apellido;

        if(isset($datos->segundo_apellido))
            $persona->segundo_apellido = $datos->segundo_apellido;

        if(isset($datos->direccion))
             $persona->direccion = $datos->direccion;

        if(isset($datos->email))
            $persona->email = $datos->email;

        //Escribir en la base de datos
        try{
            $persona->save();
            $respuesta['msg'] = "Persona actualizada ";
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
            
        }

       return response()->json($respuesta);
    
        

    }
    public function listar(){


        $respuesta = ["status" => 1,"msg"=> "" ];
        try{
            $personas = Persona::all();
            $respuesta['datos'] = $personas;

        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
            
        }

        
        return response() ->json($respuesta);
    }
    public function ver($id){

        $respuesta = ["status" => 1,"msg"=> "" ];
        try{
            $persona = Persona::find($id);
            $persona->makeVisible(['direccion','updated_at','created_at']);
            $respuesta['datos'] = $persona;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();

            
        }

       return response()->json($respuesta);
    
    }
}
