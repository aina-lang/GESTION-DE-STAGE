<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Brian2694\Toastr\Facades\Toastr;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Contrôleur de Connexion
    |--------------------------------------------------------------------------
    |
    | Ce contrôleur gère l'authentification des utilisateurs pour l'application et
    | les redirige vers l'écran d'accueil. Le contrôleur utilise un trait
    | pour fournir commodément ses fonctionnalités à vos applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Où rediriger les utilisateurs après la connexion.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Crée une nouvelle instance du contrôleur.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
            'locked',
            'unlock'
        ]);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->email;
        $password = $request->password;

        $dt         = Carbon::now();
        $todayDate  = $dt->toDayDateTimeString();
        
        if (Auth::attempt(['email' => $username, 'password' => $password, 'status' => 'Active'])) {
            /** obtenir la session */
            $user = Auth::user();
            Session::put('name', $user->name);
            Session::put('email', $user->email);
            Session::put('user_id', $user->user_id);
            Session::put('join_date', $user->join_date);
            Session::put('phone_number', $user->phone_number);
            Session::put('status', $user->status);
            Session::put('role_name', $user->role_name);
            Session::put('avatar', $user->avatar);
            Session::put('position', $user->position);
            Session::put('department', $user->department);
            
            $activityLog = [
                'name' => Session::get('name'),
                'email' => $username,
                'description' => 'S\'est connecté',
                'date_time' => $todayDate,
            ];
            DB::table('activity_logs')->insert($activityLog);
            
            Toastr::success('Connexion réussie :)', 'Succès');
            return redirect()->intended('home');
        } else {
            Toastr::error('Échec, NOM D\'UTILISATEUR OU MOT DE PASSE INCORRECT :)', 'Erreur');
            return redirect('login');
        }
    }

    public function logout(Request $request)
    {
        $dt         = Carbon::now();
        $todayDate  = $dt->toDayDateTimeString();

        $activityLog = [
            'name' => Session::get('name'),
            'email' => Session::get('email'),
            'description' => 'S\'est déconnecté',
            'date_time' => $todayDate,
        ];
        DB::table('activity_logs')->insert($activityLog);
        
        // oublier la session de connexion
        $request->session()->forget('name');
        $request->session()->forget('email');
        $request->session()->forget('user_id');
        $request->session()->forget('join_date');
        $request->session()->forget('phone_number');
        $request->session()->forget('status');
        $request->session()->forget('role_name');
        $request->session()->forget('avatar');
        $request->session()->forget('position');
        $request->session()->forget('department');
        $request->session()->flush();
        Auth::logout();
        Toastr::success('Déconnexion réussie :)', 'Succès');
        return redirect('login');
    }
}
