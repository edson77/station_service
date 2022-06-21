<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Privilege;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');
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
}
