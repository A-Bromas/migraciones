<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class PersonasController extends Controller
{
    //
    public function crear(Request $req){
        
        $datos = $req ->getContent();

        //VALIDAR EL JSON

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
        }catch(\Exception $e){

            die($e->getMessage());
        }

        die("Bien");
    
        

    }
}
