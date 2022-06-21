<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MercurySeries\Flashy\Flashy;

class AuthController extends Controller
{
    public function  __construct(){
        $this->middleware('guest');
    }


    public function index(){
        return view('auth.login');
    }

    public function login(Request $request){
        $ip = $_SERVER['REMOTE_ADDR'];
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $time = time() +3600;

        //ca retourne true si les informations sont correctent et false sinon
        if(!Auth::attempt(['identifiant' => $request->identifiant,'password' => $request->mdp,'is_deleted' =>0]))
        {

            Flashy::error('Votre Identifiant où mot de passe est incorrect');
            return redirect()->back();

        }else{

            $log = new Log();
            $log->libelle = 'Authentification de l\'utilisateur '.Auth::user()->prenom.' '.Auth::user()->nom.' '.Auth::user()->id_privileges;
            $log->auteur = Auth::user()->id;
            $log->jour = date('Y-m-d');
            $log->save();

            $session = new Session();
            $session->id = 'sessions_'.time();
            $session->user_id = Auth::user()->id;
            $session->role = Auth::user()->id_privileges;
            $session->ip_address = $ip;
            $session->user_agent = $agent;
            $session->last_activity =$time;
            $session->created_at = Carbon::now();
            $session->updated_at = Carbon::now();
            $session->save();

            Flashy::success('Bienvenu Mr/Mme: '.Auth::user()->prenom.' '.Auth::user()->nom);
            return redirect()->route('home');
        }
    }

    public function logout(){
        $log = new Log();
        $log->libelle = 'Déconnection de l\'utilisateur '.Auth::user()->name.' '.Auth::user()->role;
        $log->auteur = Auth::user()->id;
        $log->jour = date('Y-m-d');
        $log->save();
        auth()->logout();
        flashy()->success('Deconnexion reussit avec success.');
        return redirect()->route('login');
    }

    //fonction pour creer un utilisateur
    public function register(Request $request)
    {

        $this->validate($request, [
            'nom' => 'required|min:3|max:255',
            'prenom' => 'required|min:3|max:255',
            'phone' => 'required|string|min:5|max:255|unique:users',
            'identifiant' => 'required|min:5|unique|max:20',
            'motdepasse' => 'required|string|min:6|confirmed',
            // 'password_confirmation' => 'required_with:password|same:password|min:6',

        ]);
        $slug = Str::slug($request->nom.'&'.$request->prenom.'-'.time());
        $user =   User::create(
            [
                'nom' =>e( $request->nom),
                'prenom' =>e( $request->prenom),
                'mail' =>e($request->mail),
                'tel' =>e($request->mail),
                'identifiant' =>e($request->identifiant),
                'motdepasse' =>e($request->mdp),
                'id_privileges' =>e($request->privilege),

            ]);

        /* $verifyUser = VerifyUser::create([
             'user_id' => $user->id,
             'token' =>  $key
         ]);*/

        /*  $email = $request->email;
          //pour verifier si c est une adresse email
          if (filter_var($email, FILTER_VALIDATE_EMAIL)){
              \Mail::to($user->email)->send(new VerifyMail($user));
          }*/
       // auth()->loginUsingId($user->id);
        return redirect()->back();
    }
}
