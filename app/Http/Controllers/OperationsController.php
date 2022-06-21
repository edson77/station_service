<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperationsRequests;
use App\Models\Bon;
use App\Models\Citerne;
use App\Models\Client;
use App\Models\Consommation;
use App\Models\Log;
use App\Models\Notification;
use App\Models\Transaction;
use App\Models\Voiture;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;

class OperationsController extends Controller
{
    public function  __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $citernes = Citernes::all();

        return view('citerne.index',[
            'citernes' => $citernes
        ]);
    }
    public function create(){

        $stations = DB::select("SELECT id, adresse FROM station_service");
        $clients = Client::all();
        $voitures = Voiture::all();
        return view('operations.create', compact('stations','clients','voitures'));
    }
    public function store(Request $request){

        $carburantLivree = 0;
        $montypeCarburant = $request->typeCarburantConsommer;
        $carburantLivrees =DB::select("SELECT carburantLivree FROM systeme_de_controle_operations WHERE typeCarburant = :typeCarburant",['typeCarburant' =>$montypeCarburant]);

        foreach ($carburantLivrees as $dispo){
            $carburantLivree = $carburantLivree + (double)$dispo->carburantLivree;
        }

        $carburantConsomme = 0;
        $carburantConsommes =DB::select("SELECT carburantConsommer FROM systeme_de_controle_operations WHERE typeCarburant = :typeCarburant",['typeCarburant' =>$montypeCarburant]);
        foreach ($carburantConsommes as $dispo){
            $carburantConsomme = $carburantConsomme + (double)$dispo->carburantConsommer;
        }
        $disponible = $carburantLivree - $carburantConsomme;

        if ($disponible<= (double)$request->quantiteConsommation){
            Flashy::error("l'opération n'a pas pu etre effectuée. nous ne disposons plus d'assez de carburant");
            return redirect()->back();
        }
        // verifier si la quantité de carburant est disponible
        $quantiteeDisponible=0;
        $typecarb = $request->typeCarburantConsommer;
        $typeCarburantsExist = DB::select("SELECT type_carburant FROM citerne WHERE type_carburant = :type_carburant",
            [
                'type_carburant' => $typecarb
            ]);
       // dd($typeCarburantsExist);
        if (empty($typeCarburantsExist)){
            Flashy::error("l'opération n'a pas pu etre effectuée car nous ne disposons pas de ce type de carburant");
            return redirect()->back();
        }
        $livrees= DB::select("SELECT quantiteLivree FROM citerne WHERE type_carburant = :type_carburant",
            [
                'type_carburant' => $typecarb
            ]);
        foreach ($livrees as $livree){
            $quantiteeDisponible = $quantiteeDisponible + $livree->quantiteLivree;
        }
       // dd($quantiteeDisponible);
        if ($quantiteeDisponible <=$request->quantiteConsommation ){
            Flashy::error("l'opération n'a pas pu etre effectuée car il y'a plus assez de carburant");
            return redirect()->back();
        }

       // dd("je suis la");

        $vehicules = Voiture::all('immatriculation');
        $bons = Bon::all();

        if ($request->modePayement == "boncarburant"){

            if (!empty($bons->toArray()))
            {

                foreach ($bons as $bon){


                    if ((string)trim($bon->identifiant) === (string)trim($request->bonid) AND $bon->status == 0)
                    {
                        DB::update("UPDATE bons SET status = '1' WHERE identifiant = :identifiant",['identifiant' => (string)$request->bonid]);
                    }else{
                        Flashy::error(" ID du bon n'est pas correcte où est éronné");
                        return redirect()->back();
                    }
                }

            }else{
                Flashy::error(" vous ne disposez pas d'un bon de carburant");
                return redirect()->back();
        }
        }

       // dd($vehicules);
       // dd(!empty($vehicules->toArray()));

        if (!empty($vehicules->toArray())){
           // dd("je suis la 1");


            foreach ($vehicules  as $v){


                if($v->immatriculation == $request->immatriculation  || $v->immatriculation == $request->matricule){
                    //dd("je suis la immatriculation");
                    DB::insert("INSERT INTO systeme_de_controle_operations(date_jour,carburantLivree,carburantConsommer,typeCarburant)
                            VALUES (:date_jour,:carburantLivree,:carburantConsommer,:typeCarburant)",
                        [
                            'date_jour' =>Carbon::now(),
                            'carburantLivree' =>0,
                            'carburantConsommer' =>$request->quantiteConsommation,
                            'typeCarburant' => $request->typeCarburantConsommer
                        ]);

                    $consommation = new Consommation();
                    $consommation->date_consomation = $request->Dateconsommation;
                    $consommation->quantite_carburant = $request->quantiteConsommation;
                    $consommation->montant_consomation = $request->montantConso;
                    $consommation->typeCarburant = $request->typeCarburantConsommer;
                    $consommation->id_station_service = $request->stationID;
                    $consommation->immatriculation = $request->matricule;
                    $consommation->pompe = $request->pompe;
                    $consommation->modepayement = $request->modePayement;
                    //$consommation->id_citerne = $request->idciterne;
                    $consommation->numeroCNI = $request->cni3;
                    $consommation->save();

                    //enregistrer la transaction d'achat ou de vente
                    $nom = Auth::user()->nom.' '.Auth::user()->prenom;
                    Transaction::create([
                        'numero' =>date('Y').'TRANSACTION'.time(),
                        "recettes" =>(double)$request->montantConso,
                        'depenses' => 0,
                        'date_jour' =>Carbon::now(),
                        'caissier' =>$nom,

                    ]);

                    //notification
                    $touslesid =[];
                    $idUsers =  DB::select("SELECT id FROM users WHERE (id_privileges = :p1 OR id_privileges = :p2 OR id_privileges = :p3) AND id != :id",[
                        'p1' => 3,
                        'p2' => 4,
                        'p3' => 1,
                        'id' => Auth::user()->id
                    ]);
                   /* $idUsers = User::select("id")
                        ->where('id_privileges','=',3)
                        ->orWhere('id_privileges','=',4)
                        ->orWhere('id','!=',Auth::user()->id)
                        ->get();*/
                    foreach ($idUsers as $idUser){
                        $touslesid[] = $idUser->id;
                    }

                    for ($i=0; $i< count($touslesid); $i++){
                        $notification = new Notification();
                        $notification->message = Auth::user()->nom.' '.Auth::user()->prenom." vient d'enregistré la consommation du vihicule immatriculé".$request->immatriculation;
                        $notification->send = Auth::user()->id;
                        $notification->received = $touslesid[$i];
                        $notification->unread = "0";
                        $notification->created_at = Carbon::now();
                        $notification->updated_at = Carbon::now();
                        $notification->save();
                    }
                    //enregistrement des logs
                    $log = new Log();
                    $log->libelle = Auth::user()->nom.' '.Auth::user()->prenom." vient d'enregistré la consommation du vihicule immatriculé".$request->immatriculation."Appartenant à ".$request->nom;
                    $log->auteur = Auth::user()->id;
                    $log->jour = date('Y-m-d');
                    $log->save();

                    Flashy::success("l'opération d'enregistrement de la consommation a été realisée avec success");
                    return redirect()->back();
                }else{
                   // dd("je suis la client");

                    //creation d un client
                    $client = new Client();
                    $client->numeroCNI = $request->cni;
                    $client->nom = $request->nom;
                    $client->tel = $request->tel;
                    $client->grade = $request->grade;
                    $client->fonction = $request->fonction;
                    if ($client->save()){
                        $voiture = new Voiture();
                        $voiture->immatriculation = $request->immatriculation;
                        $voiture->marque = $request->marque;
                        $voiture->modele = $request->modele;
                        $voiture->typeCarburant = $request->typeCarburant;
                        $voiture->numeroCNI = $client->numeroCNI;
                        if($voiture->save()){
                            DB::insert("INSERT INTO systeme_de_controle_operations(date_jour,carburantLivree,carburantConsommer,typeCarburant)
                            VALUES (:date_jour,:carburantLivree,:carburantConsommer,:typeCarburant)",
                                [
                                    'date_jour' =>Carbon::now(),
                                    'carburantLivree' =>0,
                                    'carburantConsommer' =>$request->quantiteConsommation,
                                    'typeCarburant' => $request->typeCarburantConsommer
                                ]);

                            $consommation = new Consommation();
                            $consommation->date_consomation = $request->Dateconsommation;
                            $consommation->quantite_carburant = $request->quantiteConsommation;
                            $consommation->montant_consomation = $request->montantConso;
                            $consommation->typeCarburant = $request->typeCarburantConsommer;
                            $consommation->id_station_service = $request->stationID;
                            $consommation->immatriculation = $request->immatriculation;
                            $consommation->pompe = $request->pompe;
                            $consommation->modepayement = $request->modePayement;
                            //$consommation->id_citerne = $request->idciterne;
                            $consommation->numeroCNI = $request->cni;
                            $consommation->save();

                            //enregistrer la transaction d'achat ou de vente
                            $nom = Auth::user()->nom.' '.Auth::user()->prenom;
                            Transaction::create([
                                'numero' =>date('Y').'TRANSACTION'.time(),
                                "recettes" =>(double)$request->montantConso,
                                'depenses' => 0,
                                'date_jour' =>Carbon::now(),
                                'caissier' =>$nom,

                            ]);
                        }

                        //notification
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

                        for ($i=0; $i< count($touslesid); $i++){
                            $notification = new Notification();
                            $notification->message = Auth::user()->nom.' '.Auth::user()->prenom." vient d'enregistré la consommation du vihicule immatriculé".$request->immatriculation."Appartenant à ".$request->nom;
                            $notification->send = Auth::user()->id;
                            $notification->received = $touslesid[$i];
                            $notification->unread = "0";
                            $notification->created_at = Carbon::now();
                            $notification->updated_at = Carbon::now();
                            $notification->save();
                        }

                        //enregistrement des logs
                        $log = new Log();
                        $log->libelle = Auth::user()->nom.' '.Auth::user()->prenom." vient d'enregistré la consommation du vihicule immatriculé".$request->immatriculation."Appartenant à ".$request->nom;
                        $log->auteur = Auth::user()->id;
                        $log->jour = date('Y-m-d');
                        $log->save();
                    }
                    Flashy::success("l'opération d'enregistrement du client, du vehicule et de la consommation a été réalisée avec success");
                    return redirect()->back();

                }
            }
        }else{
           // dd("ca n existe pas");
            //creation d un client
            $client = new Client();
            $client->numeroCNI = $request->cni;
            $client->nom = $request->nom;
            $client->tel = $request->tel;
            $client->grade = $request->grade;
            $client->fonction = $request->fonction;
            if ($client->save()){
                $voiture = new Voiture();
                $voiture->immatriculation = $request->immatriculation;
                $voiture->marque = $request->marque;
                $voiture->modele = $request->modele;
                $voiture->typeCarburant = $request->typeCarburant;
                $voiture->numeroCNI = $client->numeroCNI;
                if($voiture->save()){
                    DB::insert("INSERT INTO systeme_de_controle_operations(date_jour,carburantLivree,carburantConsommer,typeCarburant)
                            VALUES (:date_jour,:carburantLivree,:carburantConsommer,:typeCarburant)",
                        [
                            'date_jour' =>Carbon::now(),
                            'carburantLivree' =>0,
                            'carburantConsommer' =>$request->quantiteConsommation,
                            'typeCarburant' => $request->typeCarburantConsommer
                        ]);
                    $consommation = new Consommation();
                    $consommation->date_consomation = $request->Dateconsommation;
                    $consommation->quantite_carburant = $request->quantiteConsommation;
                    $consommation->montant_consomation = $request->montantConso;
                    $consommation->typeCarburant = $request->typeCarburantConsommer;
                    $consommation->id_station_service = $request->stationID;
                    $consommation->immatriculation = $request->immatriculation;
                    $consommation->pompe = $request->pompe;
                    $consommation->modepayement = $request->modePayement;
                    //$consommation->id_citerne = $request->idciterne;
                    $consommation->numeroCNI = $request->cni;
                    $consommation->save();

                    //enregistrer la transaction d'achat ou de vente
                    $nom = Auth::user()->nom.' '.Auth::user()->prenom;
                    Transaction::create([
                        'numero' =>date('Y').'TRANSACTION'.time(),
                        "recettes" =>(double)$request->montantConso,
                        'depenses' => 0,
                        'date_jour' =>Carbon::now(),
                        'caissier' =>$nom,

                    ]);
                }
            }

            //notification
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

            for ($i=0; $i< count($touslesid); $i++){
                $notification = new Notification();
                $notification->message = Auth::user()->nom.' '.Auth::user()->prenom." vient d'enregistré la consommation du vihicule immatriculé".$request->immatriculation."Appartenant à ".$request->nom;
                $notification->send = Auth::user()->id;
                $notification->received = $touslesid[$i];
                $notification->unread = "0";
                $notification->created_at = Carbon::now();
                $notification->updated_at = Carbon::now();
                $notification->save();
            }
            //enregistrement des logs
            $log = new Log();
            $log->libelle = Auth::user()->nom.' '.Auth::user()->prenom." vient d'enregistré la consommation du vihicule immatriculé".$request->immatriculation."Appartenant à ".$request->nom;
            $log->auteur = Auth::user()->id;
            $log->jour = date('Y-m-d');
            $log->save();

            Flashy::success("l'opération d'enregistrement du client, du vehicule et de la consommation a été réalisée avec success");
            return redirect()->back();
        }


    }
}
