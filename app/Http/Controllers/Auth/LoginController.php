<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Usuarios;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    protected $guard = 'usuarios';

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:usuarios')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function logout()
    {
        Auth::guard('usuarios')->logout();
        return redirect('/login');
    }

    public function login(Request $request)
    {
        /*
            ^ Obtener al usuario mediante el email
            ^ Validar que existe el usuario
                ^ Verificar coincidencias entre la clave ingresada con la clave de la BBDD
                    ^ Obtener el rol del usuario
                    ^ Retornar la vista adecuada para el rol
            ^ Si no cumple con las validaciones retornar mensaje de error. 
        */
        $admin = Usuarios::where('usua_email', $request->usua_email)->first();
        if ($admin) {
            if(($request->usua_pasw == $admin->usua_pasw)){
                // Poner TRUE en caso de ser necesario
                $user = Auth::loginUsingId($admin->usua_codi);  
                $id = auth()->user()->usua_codi;
                $rol = DB::table('usuarios')
                    ->where('usua_codi', $id)
                    ->where('usua_tipo', 1)
                    ->get();
        
                if(json_encode($rol) == "[]"){
                    return redirect('/home');
                }else{
                    return redirect('/admin');
                }
            }
            return back()->withErrors([
                'error' => 'Las credenciales no son correctas!',
            ]);
        }
        return back()->withErrors([
            'error' => 'Las credenciales no son correctas!',
        ]);
    }

    protected function guard(){
        return Auth::guard('usuarios');
    }
}
