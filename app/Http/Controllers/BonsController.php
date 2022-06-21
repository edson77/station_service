<?php

namespace App\Http\Controllers;

use App\Models\Bon;
use App\Models\Citerne;
use App\Models\Client;
use App\Models\Log;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;

class BonsController extends Controller
{

    public function  __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $bons = Bon::where('status', 0)
            ->orderby('date_bon','DESC')->get();
        $categories =  DB::select("SELECT DISTINCT categorie FROM bons");
        $montants =  DB::select("SELECT DISTINCT montant FROM bons");
        $localites =  DB::select("SELECT DISTINCT localite FROM bons");
     return view('bons.index', compact('bons','montants','categories','localites'));
    }
    public function deleted(){
        $bons = Bon::where('status', 2)
            ->orderby('date_bon','DESC')->get();
        return view('bons.deleted', compact('bons'));
    }
    public function used(){
        $bons = Bon::where('status', 1)
            ->orderby('date_bon','DESC')->get();
        return view('bons.used', compact('bons'));
    }
    public function show($id){
        $bons = Bon::where('identifiant', $id)->get();
        $bonss = [];
        foreach ($bons as $b)
        {
            $bonss[] = $b;
        }
        $bon =$bonss[0];
        //dd($bon);
        return view('bons.show', compact('bon'));
    }

    public function create(){
        $clients = Client::all();
      //  dd($clients);
        return view("bons.create", compact("clients"));
    }

    public function delete($id){
            Bon::where('identifiant',$id)->update(['status' => 2]);
            Flashy::success("le bon a été supprimé avec success");
            return redirect()->back();

    }
    public function restore($id){
        Bon::where('identifiant',$id)->update(['status' => 0]);
        Flashy::success("le bon a été restoré avec success");
        return redirect()->back();
    }

    public function store(Request $request){
        Bon::create([
            'identifiant' => 'BON-'.time(),
            'categorie' =>$request->categorie,
            'date_bon' =>$request->delivrance,
            'localite' =>$request->localite,
            'nom' =>$request->nom,
            'montant' =>$request->montant,
            'libelle' =>$request->libelle,
        ]);

        Flashy::success("l'opération d'attribution des bons d'essences a été réalisée avec succes");
        return redirect()->back();

        return redirect()->back();
    }

    public  function search(Request $request)
    {
        if (empty($request->categorie) AND empty($request->montant) AND empty($request->localite))
        {
            Flashy::error("vous devez selectionner au moins un élément");
            return redirect()->back();
        }else{
            if (!empty($request->categorie))
            {
                if (!empty($request->montant))
                {
                    if (!empty($request->localite))
                    {
                        $bons = Bon::where('categorie', $request->categorie)
                            ->where('montant',$request->montant)
                            ->where('localite',$request->localite)
                            ->get();
                        return view('bons.search', compact('bons'));
                    }else{
                        $bons = Bon::where('categorie', $request->categorie)
                            ->where('montant',$request->montant)
                            ->get();
                        return view('bons.search', compact('bons'));
                    }
                }else{
                    if (!empty($request->localite))
                    {
                        $bons = Bon::where('categorie', $request->categorie)
                            ->where('localite',$request->localite)
                            ->get();
                        return view('bons.search', compact('bons'));
                    }else{
                        $bons = Bon::where('categorie', $request->categorie)
                            ->get();
                        return view('bons.search', compact('bons'));
                    }

                }
            }else{
                if (!empty($request->montant))
                {
                    if (!empty($request->localite))
                    {
                        $bons = Bon::where('montant',$request->montant)
                            ->where('localite',$request->localite)
                            ->get();
                        return view('bons.search', compact('bons'));
                    }else{
                        $bons = Bon::where('montant',$request->montant)
                            ->get();
                        return view('bons.search', compact('bons'));
                    }
                }else{
                    if (!empty($request->localite))
                    {
                        $bons = Bon::where('localite',$request->localite)
                            ->get();
                        return view('bons.search', compact('bons'));
                    }else{

                        Flashy::error("vous devez selectionner au moins un élément");
                        return redirect()->back();
                    }

                }

            }
        }
    }

    public function printBon(){
        $bons = Bon::orderBy('date_bon', 'desc')->get();


        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'orientation' => 'landscape']);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->setHTMLFooter("
                                <div align='center' style='font-size: 13px'>
                                    <b>PETROLIUM</b> Plateforme de Gestion des stations services designed by <b>Edson Bitjoka </b>.<br>-- Ydé Cameroun -- Tel: (+237) 697878606 
                                </div>
                             ");

        $log = new Log();
        $log->libelle = 'Impression de la liste des bons de carburant';
        $log->auteur = Auth::user()->id;
        $log->jour = date('Y-m-d');
        $log->save();

        ob_start();
        echo view('bons.print', compact('bons'));
        $html = ob_get_contents();
        ob_end_clean();

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
    public function printBonId($id)
    {
        $bons = Bon::where('identifiant', $id)->get();
        $bonss = [];
        foreach ($bons as $b)
        {
            $bonss[] = $b;
        }
        $bon =$bonss[0];
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'orientation' => 'landscape']);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->setHTMLFooter("
                                <div align='center' style='font-size: 13px'>
                                    <b>PETROLIUM</b> Plateforme de Gestion des stations services designed by <b>Edson Bitjoka </b>.<br>-- Ydé Cameroun -- Tel: (+237) 697878606 
                                </div>
                             ");

        $log = new Log();
        $log->libelle = "Impression d'un utilisateur";
        $log->auteur = Auth::user()->id;
        $log->jour = date('Y-m-d');
        $log->save();

        ob_start();
        echo view('bons.printbon', compact('bon'));
        $html = ob_get_contents();
        ob_end_clean();

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
