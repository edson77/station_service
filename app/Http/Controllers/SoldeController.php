<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;

class SoldeController extends Controller
{
    public function solde(Request $request)
    {
        Transaction::create([
            'numero' =>date('Y').'INJECTION'.time(),
            "recettes" =>(double)($request->montant),
            'depenses' =>0,
            'date_jour' =>Carbon::now(),

        ]);
        Flashy::success("l'opération a été executer avec success");
            return redirect()->back();
    }
}
