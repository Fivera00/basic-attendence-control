<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        /*
            ^ Verificar si un usuario esta logeado
            ^ Validar que el usuario que accesa a este controlador solo sea usuario administrador
        */
        $this->middleware('auth:usuarios');
        $this->middleware('admin');
    }

    public function index(){
        /*
            Se obtienen los registros de asistencia de los trabajadores
            Pasamos los datos a la vista para representarlos 
        */
        $registro = DB::table('marcaciones')
            ->join('usuarios', 'id_usuario', '=', 'usuarios.usua_codi')
            ->select('marcaciones.*', 'usuarios.usua_nomb','usuarios.usua_email',)
            ->whereDate('fecha_registro', 'now()')
            ->orderBy('fecha_registro','DESC')
            ->get();

        return view('admin.listado')->with('trabajadores',$registro);
    }

    public function marcar(){
        /*
            ^ Se obtiene el ultimo registro de la asistencia del trabajador
            ^ Si no hay una asistencia, se retorna a la vista con un predeterminado
            ^ Caso contrario se retorna a la vista con la fecha y hora del ultimo registro 
        */ 
        $id = auth()->user()->usua_codi;
        $registro = DB::table('marcaciones')
            ->where('id_usuario', $id)
            ->orderBy('id','desc')
            ->limit(1)
            ->get();
        
        if(json_encode($registro) == "[]"){
            return view('admin.marcar')
            ->with('fecha',"No presenta registros")
            ->with('hora', "");
        }
        
        return view('admin.marcar')
            ->with('fecha',$registro[0]->fecha_registro)
            ->with('hora', $registro[0]->hora_resgistro);
    }

    public function registrar(Request $request){
        /*
            ^ Validar que el id este disponible
            ^ Registrar la asistencia en la BBDD. Se uso un consulta especial para generar el campo de estado
            ^ Como es administrador, regresa a la vista de reportes
        */
        $this->validate($request, [
            'id'   => 'required'
        ]);

        DB::insert("INSERT INTO marcaciones(id_usuario, estado) VALUES ('$request->id', (CASE WHEN (( SELECT COUNT(*) AS Estado FROM marcaciones p WHERE p.id_usuario = $request->id ) % 2 = 0 )  THEN 'Entrada' ELSE 'Salida' END ))");
        // dd($request);
        return redirect('/admin');

    }

    public function buscar(Request $request){
        /*
            Generar la consulta a la BBDD y almacenarlo en una variable para enviar los datos a la vista por medio de la variable
        */
        $registro = DB::table('marcaciones')
            ->join('usuarios', 'id_usuario', '=', 'usuarios.usua_codi')
            ->select('marcaciones.*', 'usuarios.usua_nomb','usuarios.usua_email',)
            ->whereDate('fecha_registro', $request->date)
            ->get();

        
        return view('admin.listado')->with('trabajadores',$registro);
    }
}
