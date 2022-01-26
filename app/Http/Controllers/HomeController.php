<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*
            ^ Verificar si un usuario esta logeado
            ^ Redireccionar al usuario de acuerdo a su rol
        */
        $this->middleware('auth:usuarios');
        $this->middleware('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
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
            return view('home')
            ->with('fecha',"No presenta registros")
            ->with('hora', "");
        }
        
        return view('home')
            ->with('fecha',$registro[0]->fecha_registro)
            ->with('hora', $registro[0]->hora_resgistro);
    }

    public function registrar(Request $request){
        /*
            ^ Validar que el id este disponible
            ^ Registrar la asistencia en la BBDD. Se uso un consulta especial para generar el campo de estado
            ^ Como es un trabajar, se cierra sesion automaticamente
        */
        $this->validate($request, [
            'id'   => 'required'
        ]);
        $sql = DB::insert("INSERT INTO marcaciones(id_usuario, estado) VALUES ('$request->id', (CASE WHEN (( SELECT COUNT(*) AS Estado FROM marcaciones p WHERE p.id_usuario = $request->id ) % 2 = 0 )  THEN 'Entrada' ELSE 'Salida' END ))");
        Auth::guard('usuarios')->logout();
        return redirect('/login');


    }
}
