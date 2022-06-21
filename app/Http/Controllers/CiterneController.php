<?php

namespace App\Http\Controllers;

use App\Models\Citerne;
use App\Models\Log;
use App\Models\Notification;
use App\Models\Privilege;
use App\Models\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;

class CiterneController extends Controller
{
    const CAPACITETOTALECUVEESSENCE = 100000;
    const CAPACITETOTALECUVEGAZOIL  = 100000;
    public function  __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $citernes = Citerne::all();
        $citerne1 = DB::select("SELECT DISTINCT type_carburant FROM citerne ");
        $citerne2 = DB::select("SELECT DISTINCT compagnie FROM citerne ");
        

        return view('citerne.index',[
            'citernes' => $citernes,
            'citerne1' =>$citerne1,
            'citerne2' => $citerne2
        ]);
    }
    public function create(){

        return view('citerne.create');
    }

    public function store(Request $request){
        //dd("cool");

        $disposCarbu = DB::select("SELECT SUM(carburantLivree) total FROM systeme_de_controle_operations WHERE  	typeCarburant = :type_carburant",
            [
                'type_carburant'=> $request->typecarburant
            ]);
        $useCarbu = DB::select("SELECT SUM(carburantConsommer) total FROM systeme_de_controle_operations WHERE  	typeCarburant = :type_carburant",
            [
                'type_carburant'=> $request->typecarburant
            ]);
        $disponibleCarburant = 0;
        $utiliserCarburant = 0;
        foreach ($disposCarbu as $dispo){
           // dump($dispo->disponible);
            $disponibleCarburant = $disponibleCarburant + $dispo->total;

        }
        foreach ($useCarbu as $dispo){
            // dump($dispo->disponible);
            $utiliserCarburant = $utiliserCarburant + $dispo->total;

        }
       $capa = (double)$request->quantite + (double)$disponibleCarburant - (double)$utiliserCarburant;
       $letype = $request->typecarburant;
       if ($capa> 100000){
           Flashy::error("l'opération d'approvisionnement ne peut pas etre effectué car la citerne peut contenir que 100000 litres de carburant");
           return redirect()->back();
       }
       /*

        $recettes =DB::select("SELECT 
                      SUM(recettes) total
                      FROM transactions");


        $depenses =DB::select("SELECT 
                      SUM(depenses) total
                      FROM transactions");
        $net = (double)($recettes[0]->total) - (double)($depenses[0]->total);

        if ($net<0){
            Flashy::error("l'opération d'approvisionnement ne peut pas etre effectué car nous ne disposont d'argent");
            return redirect()->back();
        }
        if ($net <= (double)($request->montant)){
            Flashy::error("l'opération d'approvisionnement ne peut pas etre effectué car nous ne disposont d'assez d'argent pour realisser la transaction");
            return redirect()->back();
        }


        $recettes =DB::select("SELECT 
                      SUM(recettes) total
                      FROM transactions");
        */
        $touslesid =[];
        $idUsers =  DB::select("SELECT id FROM users WHERE (id_privileges = :p1 OR id_privileges = :p2 OR id_privileges = :p3) AND id != :id",[
            'p1' => 3,
            'p2' => 4,
            'p3' => 1,
            'id' => Auth::user()->id
        ]);
        foreach ($idUsers as $idUser){
            $touslesid[] = $idUser->id;
        }
        //effectuer une operation
        DB::insert("INSERT INTO systeme_de_controle_operations(date_jour,carburantLivree,carburantConsommer,typeCarburant)
                            VALUES (:date_jour,:carburantLivree,:carburantConsommer,:typeCarburant)",
            [
                'date_jour' =>Carbon::now(),
                'carburantLivree' =>$request->quantite,
                'carburantConsommer' =>0,
                'typeCarburant' =>$request->typecarburant,
            ]);

        //livraison d'essence à la station
        Citerne::create([
            'date_livraison' =>$request->datelivraison,
            'type_carburant' =>$request->typecarburant,
            'quantiteLivree' =>$request->quantite,
            'compagnie' =>$request->compagnie,
            'disponible' =>$request->quantite,
            'montant' =>$request->montant,
        ]);
        $nom = Auth::user()->nom.' '.Auth::user()->prenom;
        Transaction::create([
            'numero' =>date('Y').'TRANSACTION'.time(),
            "recettes" =>0,
            'depenses' =>(double)($request->montant),
            'date_jour' =>Carbon::now(),
            'caissier' =>$nom,

        ]);
        //enregistrement des logs
        $log = new Log();
        $log->libelle = Auth::user()->nom.' '.Auth::user()->prenom.' vient d enregistrer une nouvelle livraison de la société'.$request->compagnie.' le'.Carbon::now();
        $log->auteur = Auth::user()->id;
        $log->jour = date('Y-m-d');
        $log->save();

        //notification apres livraison

        for ($i=0; $i< count($touslesid); $i++){
            $notification = new Notification();
            $notification->message = "la compagnie ".$request->compagnie." a livrée du ".$request->typecarburant." le ".Carbon::now();
            $notification->send = Auth::user()->id;
            $notification->received = $touslesid[$i];
            $notification->unread = "0";
            $notification->created_at = Carbon::now();
            $notification->updated_at = Carbon::now();
            $notification->save();
        }


        Flashy::success("l'opération d'approvisionnement a été méné avec success");
        return redirect()->back();
    }

    public function delete($id){

            Citerne::find($id)->delete();
            Flashy::success("le contenu de la citerne a été supprimé avec success");
            return redirect()->back();

    }

    //la recherche
    public function search(Request $request){
        if ( empty($request->type_carburant) AND empty($request->compagnie))
        {
            Flashy::error("vous devez selectionner au moins un élément");
            return redirect()->back();
        }else{
            if (!empty($request->type_carburant))
            {
                if (!empty($request->compagnie))
                {
                    $citernes = Citerne::where('compagnie', $request->compagnie)
                        ->where('type_carburant',$request->type_carburant)
                        ->get();
                    return view('citerne.search', compact('citernes'));
                }else{
                    $citernes = Citerne::where('type_carburant', $request->type_carburant)
                        ->get();
                    return view('citerne.search', compact('citernes'));
                }
            }else{
                if (!empty($request->compagnie))
                {
                    $logs = Log::where('compagnie',$request->compagnie)
                        ->get();
                        return view('citerne.search', compact('citernes'));
                }else{

                    Flashy::error("vous devez selectionner au moins un élément");
                    return redirect()->back();
                }
            }
        }
    }

    public function printCiterne(){
        $citernes = Citerne::orderBy('date_livraison', 'desc')->get();

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'orientation' => 'landscape']);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->setHTMLFooter("
                                <div align='center' style='font-size: 13px'>
                                    <b>PETROLIUM</b> Plateforme de Gestion des stations services designed by <b>Edson Bitjoka </b>.<br>-- Ydé Cameroun -- Tel: (+237) 697878606 
                                </div>
                             ");

        $log = new Log();
        $log->libelle = 'Impression de la liste des livraisons';
        $log->auteur = Auth::user()->id;
        $log->jour = date('Y-m-d');
        $log->save();

        ob_start();
        echo view('citerne.print', compact('citernes'));
        $html = ob_get_contents();
        ob_end_clean();

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
