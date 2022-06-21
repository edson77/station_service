<?php
const CAPACITETOTALECUVE = 100000;
const CAPACITETOTALECUVEGAZOIL  = 100000;
use App\User;use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Mail;

$Authprivileges = DB::table('privileges')
    ->select('privilege')
    ->join('users', 'privileges.id', '=', 'users.id_privileges')
    ->where('users.id','=', Auth::user()->id)
    ->get();
$role = $Authprivileges[0]->privilege;

//dd($role);
//pour l essence
$carburantLivree = 0;
$an = date('Y');

$carburantLivrees =DB::select("SELECT carburantLivree FROM systeme_de_controle_operations WHERE typeCarburant = 'essence'");

foreach ($carburantLivrees as $dispo){
    $carburantLivree = $carburantLivree + (double)$dispo->carburantLivree;


}

$carburantConsomme = 0;
$carburantConsommes =DB::select("SELECT carburantConsommer FROM systeme_de_controle_operations WHERE typeCarburant = 'essence'");
foreach ($carburantConsommes as $dispo){
    $carburantConsomme = $carburantConsomme + (double)$dispo->carburantConsommer;
}
$disponible = $carburantLivree - $carburantConsomme;
$pourcentageCuve = ($disponible/CAPACITETOTALECUVE)*100;

//pour la gazoil
$carburantLivreeGazoil = 0;

$carburantLivreesGazoil =DB::select("SELECT carburantLivree FROM systeme_de_controle_operations WHERE typeCarburant = 'gazoil'");

foreach ($carburantLivreesGazoil as $dispo){
    $carburantLivreeGazoil = $carburantLivreeGazoil + (double)$dispo->carburantLivree;


}

$carburantConsommeGazoil = 0;
$carburantConsommesGazoil =DB::select("SELECT carburantConsommer FROM systeme_de_controle_operations WHERE typeCarburant = 'gazoil'");
foreach ($carburantConsommesGazoil as $dispo){
    $carburantConsommeGazoil = $carburantConsommeGazoil + (double)$dispo->carburantConsommer;
}
$disponibleGazoil = $carburantLivreeGazoil - $carburantConsommeGazoil;
$pourcentageCuveGazoil = ($disponibleGazoil/CAPACITETOTALECUVEGAZOIL)*100;
//dd($pourcentageCuve.'%')
$day=(int)date('d');$year=(int)date('Y');$month = (int)date('m');
$h1 =0;$h2 =0;$h3 =0;$h4 =0;$h5 =0;$h6 =0;$h7 =0;$h8 =0;$h9 =0;$h10 =0;$h11 =0;$h12 =0;
$h13 =0;$h14 =0;$h15 =0;$h16 =0;$h17 =0;$h18 =0;$h19 =0;$h20 =0;$h21 =0;$h22 =0;$h23 =0;$h24 =0;
$h25 =0;$h26 =0;$h27 =0;$h28 =0;$h29 =0;$h30 =0;$h31 =0;
$lundi =0; $mardi=0; $mercredi = 0; $jeudi = 0; $vendredi=0; $samedi=0; $dimanche=0;
$janvier=0;$fevrier=0;$mars=0;$avril=0;$mai=0;$juin=0;$juillet=0;$aout=0;$septembre=0;$octobre=0;$novembre=0;$decembre=0;
$janvier12=0;$fevrier12=0;$mars12=0;$avril12=0;$mai12=0;$juin12=0;$juillet12=0;$aout12=0;$septembre12=0;$octobre12=0;$novembre12=0;$decembre12=0;

$jours =  DB::select("SELECT EXTRACT( YEAR FROM date_jour ) annee,
                      EXTRACT( MONTH FROM date_jour ) mois,
                      EXTRACT( DAY FROM date_jour ) jour,
                      SUM(carburantConsommer) total
                      FROM systeme_de_controle_operations
                      WHERE typeCarburant = 'essence'
                      AND EXTRACT( MONTH FROM date_jour ) = :jour
                      GROUP BY annee, mois,jour",
    [
        'jour' => date('m')
    ]);
        foreach($jours as $test){

            if ((int)$test->mois = (int) date('m')){
                if($test->jour == 1){ $h1= (int)$test->total;}
                if($test->jour == 2){ $h2 = (int)$test->total;}
                if($test->jour == 3){ $h3= (int)$test->total;}
                if($test->jour == 4){ $h4= (int)$test->total;}
                if($test->jour == 5){ $h5= (int)$test->total;}
                if($test->jour == 6){ $h6= (int)$test->total;}
                if($test->jour == 7){ $h7= (int)$test->total;}
                if($test->jour == 8){ $h8= (int)$test->total;}
                if($test->jour == 9){ $h9= (int)$test->total;}
                if($test->jour == 10){ $h10= (int)$test->total;}
                if($test->jour == 11){ $h11= (int)$test->total;}
                if($test->jour == 12){ $h12= (int)$test->total;}
                if($test->jour == 13){ $h13= (int)$test->total;}
                if($test->jour == 14){ $h14= (int)$test->total;}
                if($test->jour == 15){ $h15= (int)$test->total;}
                if($test->jour == 16){ $h16= (int)$test->total;}
                if($test->jour == 17){ $h17= (int)$test->total;}
                if($test->jour == 18){ $h18= (int)$test->total;}
                if($test->jour == 19){ $h19= (int)$test->total;}
                if($test->jour == 20){ $h20= (int)$test->total;}
                if($test->jour == 21){ $h21= (int)$test->total;}
                if($test->jour == 22){ $h22= (int)$test->total;}
                if($test->jour == 23){ $h23= (int)$test->total;}
                if($test->jour == 24){ $h24= (int)$test->total;}
                if($test->jour == 25){ $h25= (int)$test->total;}
                if($test->jour == 26){ $h26= (int)$test->total;}
                if($test->jour == 27){ $h27= (int)$test->total;}
                if($test->jour == 28){ $h28= (int)$test->total;}
                if($test->jour == 29){ $h29= (int)$test->total;}
                if($test->jour == 30){ $h30= (int)$test->total;}
                if($test->jour == 31){ $h31= (int)$test->total;}
            }



        }
$semaime1 = $h1 +$h2 + $h3 + $h4 + $h4 + $h5 +$h6 +$h7;
$semaime2 = $h8 +$h9 + $h10 + $h11 + $h12 + $h13 +$h14 +$h15;
$semaime3 = $h16 +$h17 + $h18 + $h19 + $h20 + $h21 +$h22 +$h23;
$semaime4 = $h24 +$h25 + $h26 + $h27 + $h28 + $h29 +$h30 +$h31;

$mois=  DB::select("SELECT EXTRACT( YEAR FROM date_jour ) annee,
                      EXTRACT( MONTH FROM date_jour ) mois,
                      SUM(carburantConsommer) total
                      FROM systeme_de_controle_operations
                      WHERE typeCarburant = 'essence'
                      AND EXTRACT( YEAR FROM date_jour ) = :annee
                      GROUP BY annee, mois",[
                          'annee' => date('Y')
]);
foreach($mois as $test){

    if ((int)$test->annee = (int) date('Y')){
        if($test->mois == 1){ $janvier= (int)$test->total;}
        if($test->mois == 2){ $fevrier = (int)$test->total;}
        if($test->mois == 3){ $mars = (int)$test->total;}
        if($test->mois == 4){ $avril = (int)$test->total;}
        if($test->mois == 5){ $mai =(int)$test->total;}
        if($test->mois == 6){ $juin = (int)$test->total;}
        if($test->mois == 7){ $juillet = (int)$test->total;}
        if($test->mois == 8){ $aout = (int)$test->total;}
        if($test->mois == 9){ $septembre = (int)$test->total;}
        if($test->mois == 10){ $octobre = (int)$test->total;}
        if($test->mois == 11){ $novembre = (int)$test->total;}
        if($test->mois == 12){ $decembre =(int)$test->total;}

    }
}

$tests12 =  DB::select("SELECT EXTRACT( YEAR FROM created_at ) annee,
                                                EXTRACT( MONTH FROM created_at ) mois,
                                                count(*) total
                                                FROM sessions

                                                GROUP BY annee, mois
                                    ");
foreach($tests12 as $test){

    if($test->mois == 1){ $janvier12= (int)$test->total;}if($test->mois == 2){ $fevrier12 = (int)$test->total;}if($test->mois == 3){ $mars12 = (int)$test->total;}
    if($test->mois == 4){ $avril12 = (int)$test->total;}if($test->mois == 5){ $mai12 =(int)$test->total;}if($test->mois == 6){ $juin12 = (int)$test->total;}
    if($test->mois == 7){ $juillet12 = (int)$test->total;}if($test->mois == 8){ $aout12 = (int)$test->total;}if($test->mois == 9){ $septembre12 = (int)$test->total;}
    if($test->mois == 10){ $octobre12 = (int)$test->total;}if($test->mois == 11){ $novembre12 = (int)$test->total;}if($test->mois == 12){ $decembre12 =(int)$test->total;}

}

/*foreach($semaines as $test){

    if ((int)$test->mois = (int) date('m')){
        if($test->heure == 1){ $h1= (int)$test->total;}
        if($test->heure == 2){ $h2 = (int)$test->total;}
        if($test->heure == 3){ $h3= (int)$test->total;}
        if($test->heure == 4){ $h4= (int)$test->total;}
        if($test->heure == 5){ $h5= (int)$test->total;}
        if($test->heure == 6){ $h6= (int)$test->total;}
        if($test->heure == 7){ $h7= (int)$test->total;}

    }



}*/
$trimestre1 = $janvier + $fevrier + $mars;
$trimestre2 = $avril + $mai + $juin;
$trimestre3 = $juillet + $aout + $septembre;
$trimestre4 = $octobre + $novembre + $decembre;

//dd($jours);

?>
<?php


$day=(int)date('d');$year=(int)date('Y');$month = (int)date('m');
$h011 =0;$h022 =0;$h033 =0;$h044 =0;$h055 =0;$h066 =0;$h077 =0;$h088 =0;$h099 =0;$h100 =0;$h111 =0;$h122 =0;
$h133 =0;$h144 =0;$h155 =0;$h166 =0;$h177 =0;$h188 =0;$h199 =0;$h200 =0;$h211 =0;$h222 =0;$h233 =0;$h244 =0;
$h255 =0;$h266 =0;$h277 =0;$h288 =0;$h299 =0;$h300 =0;$h311 =0;
$lundi1 =0; $mardi1=0; $mercredi1 = 0; $jeudi1 = 0; $vendredi1=0; $samedi1=0; $dimanche1=0;
$janvier1=0;$fevrier1=0;$mars1=0;$avril1=0;$mai1=0;$juin1=0;$juillet1=0;$aout1=0;$septembre1=0;$octobre1=0;$novembre1=0;$decembre1=0;


$jours1 =  DB::select("SELECT EXTRACT( YEAR FROM date_jour ) annee,
                      EXTRACT( MONTH FROM date_jour ) mois,
                      EXTRACT( DAY FROM date_jour ) jour,
                      SUM(carburantConsommer) total
                      FROM systeme_de_controle_operations
                      WHERE typeCarburant = 'gazoil'
                      AND EXTRACT( MONTH FROM date_jour ) = :mois

                      GROUP BY annee, mois,jour",[
                          'mois' => date('m')
]);
foreach($jours1 as $test){

    if ((int)$test->mois = (int) date('m')){
        if($test->jour == 1){ $h011= (int)$test->total;}
        if($test->jour == 2){ $h022 = (int)$test->total;}
        if($test->jour == 3){ $h033= (int)$test->total;}
        if($test->jour == 4){ $h044= (int)$test->total;}
        if($test->jour == 5){ $h055= (int)$test->total;}
        if($test->jour == 6){ $h066= (int)$test->total;}
        if($test->jour == 7){ $h077= (int)$test->total;}
        if($test->jour == 8){ $h088= (int)$test->total;}
        if($test->jour == 9){ $h099= (int)$test->total;}
        if($test->jour == 10){ $h100= (int)$test->total;}
        if($test->jour == 11){ $h111= (int)$test->total;}
        if($test->jour == 12){ $h122= (int)$test->total;}
        if($test->jour == 13){ $h133= (int)$test->total;}
        if($test->jour == 14){ $h144= (int)$test->total;}
        if($test->jour == 15){ $h155= (int)$test->total;}
        if($test->jour == 16){ $h166= (int)$test->total;}
        if($test->jour == 17){ $h177= (int)$test->total;}
        if($test->jour == 18){ $h188= (int)$test->total;}
        if($test->jour == 19){ $h199= (int)$test->total;}
        if($test->jour == 20){ $h200= (int)$test->total;}
        if($test->jour == 21){ $h211= (int)$test->total;}
        if($test->jour == 22){ $h222= (int)$test->total;}
        if($test->jour == 23){ $h233= (int)$test->total;}
        if($test->jour == 24){ $h244= (int)$test->total;}
        if($test->jour == 25){ $h255= (int)$test->total;}
        if($test->jour == 26){ $h266= (int)$test->total;}
        if($test->jour == 27){ $h277= (int)$test->total;}
        if($test->jour == 28){ $h288= (int)$test->total;}
        if($test->jour == 29){ $h299= (int)$test->total;}
        if($test->jour == 30){ $h300= (int)$test->total;}
        if($test->jour == 31){ $h311= (int)$test->total;}
    }



}
$semaime11 = $h011 +$h022 + $h033 + $h044 + $h055 +$h066 +$h077 + $h088;
$semaime22 = $h099 + $h100 + $h111 + $h122 + $h133 +$h144 + $h155 + $h166;
$semaime33 = $h177 + $h188 + $h199 + $h200 + $h211 +$h222 +$h233 ;
$semaime44 = $h244 + $h255 + $h266 + $h277 + $h288 + $h299 +$h300 +$h311;

$mois1=  DB::select("SELECT EXTRACT( YEAR FROM date_jour ) annee,
                      EXTRACT( MONTH FROM date_jour ) mois,
                      SUM(carburantConsommer) total
                      FROM systeme_de_controle_operations
                      WHERE typeCarburant = 'gazoil'
                      AND EXTRACT( YEAR FROM date_jour ) = :annee
                      GROUP BY annee, mois",
    [
        'annee' => date('Y')
    ]);
foreach($mois1 as $test){

    if ((int)$test->annee = (int) date('Y')){
        if($test->mois == 1){ $janvier1= (int)$test->total;}
        if($test->mois == 2){ $fevrier1 = (int)$test->total;}
        if($test->mois == 3){ $mars1 = (int)$test->total;}
        if($test->mois == 4){ $avril1 = (int)$test->total;}
        if($test->mois == 5){ $mai1 =(int)$test->total;}
        if($test->mois == 6){ $juin1 = (int)$test->total;}
        if($test->mois == 7){ $juillet1 = (int)$test->total;}
        if($test->mois == 8){ $aout1 = (int)$test->total;}
        if($test->mois == 9){ $septembre1 = (int)$test->total;}
        if($test->mois == 10){ $octobre1 = (int)$test->total;}
        if($test->mois == 11){ $novembre1 = (int)$test->total;}
        if($test->mois == 12){ $decembre1 =(int)$test->total;}

    }
}



$trimestre11 = $janvier1 + $fevrier1 + $mars1;
$trimestre22 = $avril1 + $mai1 + $juin1;
$trimestre33 = $juillet1 + $aout1 + $septembre1;
$trimestre44 = $octobre1 + $novembre1 + $decembre1;

//dd($trimestre22);

?>
@extends('layouts.app')
@section('title', "Home")
@section('css')
    <style>

    </style>
@endsection

@section('content')
    <br>
    @if($role === "chef sed" || $role === "responsable station")
        @if( $pourcentageCuve <= 10 || $pourcentageCuveGazoil <= 10)
            <?php

               $resultats = DB::select("SELECT id, status, jour FROM alerte");
               if (!empty($resultats))
               {
                   foreach ($resultats as $resultat){
                       //dd($resultat->jour.'='.date('Y-m-d'));
                       if ($resultat->jour == date('Y-m-d') AND $resultat->status == 1){
                           dd("le mail est deja envoye");
                       }
                       if ($resultat->jour != date('Y-m-d') AND $resultat->status == 1){

                           //dd("lalalala");

                           $touslesmail =[];
                           $mailUsers = User::select("mail")
                               ->where('id_privileges','=',3)
                               ->orWhere('id_privileges','=',4)
                               ->get();
                           foreach ($mailUsers as $idUser){
                               $touslesmail[] = $idUser->mail;
                           }
                           $data = array(
                               'email' =>''
                           );
                           $data['email'] = "edsonelmar@gmail.com";


                           for ($i=0; $i< count($touslesmail); $i++){

                               //dump($touslesmail[$i]);



                               $data['email'] = $touslesmail[$i];


                               try {
                                   // Mail::to($data['email'])->send(new contactMail());
                                   Mail::send('notif', $data, function ($message) use ($data) {
                                       $message->from('gedsed2019@gmail.com', 'GED SED');
                                       $message->to($data['email'])->subject('Alert Carburan');
                                   });
                               } catch (Exception $e) {

                               }
                              //dump($data['email']);

                           }
                           //die();

                           DB::insert("INSERT INTO alerte(jour, status) VALUES (:jour, :status)",
                               [
                                   'jour' =>date('Y-m-d'),
                                   'status' => 1,
                               ]);

                           //le mail pour reactualiser l envoi
                          // dd('mail reactualise');
                       }
                   }
               }else{
                   //pour effectuer l envoi par mail
                   DB::insert("INSERT INTO alerte(jour, status) VALUES (:jour, :status)",
                       [
                           'jour' =>date('Y-m-d'),
                           'status' => 1,
                       ]);
                   //dd(" executer");
               }


            ?>
        <div class="alert alert-primary alert-icon" role="alert">
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="alert-icon-aside">
                <i  data-feather="alert-triangle"></i>
            </div>
            <div class="alert-icon-content">
                <h6 class="alert-heading">Niveau de carburant inferieur à 10%</h6>
                Il faut recharger la citerne !
            </div>
        </div>
        @endif
        <div class="row">

                @if( $pourcentageCuve> 25)
                    <div class="col-md-6">
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{$pourcentageCuve}}%" aria-valuenow="{{$pourcentageCuve}}" aria-valuemin="0" aria-valuemax="{{CAPACITETOTALECUVE}}">{{$pourcentageCuve}}%</div>
                        </div>
                        <h1 class="text-center">Jauge à Essence</h1>
                    </div>
                @endif
                @if( $pourcentageCuve <= 25 && $pourcentageCuve > 10)
                    <div class="col-md-6">
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{$pourcentageCuve}}%" aria-valuenow="{{$pourcentageCuve}}" aria-valuemin="0" aria-valuemax="{{CAPACITETOTALECUVE}}">{{$pourcentageCuve}}%</div>
                        </div>
                        <h1 class="text-center">Jauge à Essence</h1>
                    </div>
                @endif
                @if( $pourcentageCuve<= 10)
                    <div class="col-md-6">
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{$pourcentageCuve}}%" aria-valuenow="{{$pourcentageCuve}}" aria-valuemin="0" aria-valuemax="{{CAPACITETOTALECUVE}}">{{$pourcentageCuve}}%</div>
                        </div>
                        <h1 class="text-center">Jauge à Essence</h1>
                    </div>
                @endif

            <!-- pour le gazoil -->

                @if( $pourcentageCuveGazoil> 25)
                    <div class="col-md-6">
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{$pourcentageCuveGazoil}}%" aria-valuenow="{{$pourcentageCuveGazoil}}" aria-valuemin="0" aria-valuemax="{{CAPACITETOTALECUVEGAZOIL}}">{{$pourcentageCuveGazoil}}%</div>
                        </div>
                        <h1 class="text-center">Jauge à Gazoil</h1>
                    </div>
                @endif
                @if( $pourcentageCuveGazoil <= 25 && $pourcentageCuveGazoil > 10)
                    <div class="col-md-6">
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{$pourcentageCuveGazoil}}%" aria-valuenow="{{$pourcentageCuveGazoil}}" aria-valuemin="0" aria-valuemax="{{CAPACITETOTALECUVEGAZOIL}}">{{$pourcentageCuveGazoil}}%</div>
                        </div>
                        <h1 class="text-center">Jauge à Gazoil</h1>
                    </div>
                @endif
                @if( $pourcentageCuveGazoil<= 10)
                    <div class="col-md-6">
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{$pourcentageCuveGazoil}}%" aria-valuenow="{{$pourcentageCuveGazoil}}" aria-valuemin="0" aria-valuemax="{{CAPACITETOTALECUVEGAZOIL}}">{{$pourcentageCuveGazoil}}%</div>
                        </div>
                        <h1 class="text-center">Jauge à Gazoil</h1>
                    </div>
                @endif

        </div>

    @endif
    <br>
    <div class="row">
        <div class="col-md-10 offset-1">
            <div class="sidenav-dark">
                <h1 style="color: white; padding-left: 10px; padding-bottom: 3px;padding-top: 3px;" >les statistiques</h1>
            </div>
        </div>
    </div>
    @if($role === "chef sed" || $role === "agent pompiste" || $role === "responsable station")
        <div class="row">
            <div class="col-md-4">
                <div class="sidenav-dark">
                    <h6 style="color: white; padding-left: 10px; padding-bottom: 3px;padding-top: 3px;" >Consommation par jour</h6>
                </div>
            </div>
            <div class="col-md-8">

            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <canvas  class="conso-jour" width="400" height="250"></canvas>
            </div>
            <div class="col-md-6">
                <canvas  class="conso-jour-gazoil" width="400" height="250"></canvas>
            </div>
        </div>
    @endif
    @if($role === "chef sed" || $role === "agent pompiste" || $role === "responsable station")
        <div class="row">
            <div class="col-md-4">
                <div class="sidenav-dark">
                    <h6 style="color: white; padding-left: 10px; padding-bottom: 3px;padding-top: 3px;" >Consommation par Semaine</h6>
                </div>
            </div>
            <div class="col-md-8">

            </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <canvas  class="conso-semaine" width="400" height="250"></canvas>
        </div>
        <div class="col-md-6">
            <canvas  class="conso-semaine-gazoil" width="400" height="250"></canvas>
        </div>

    </div>
    @endif
    @if($role === "chef sed" || $role === "responsable station")
        <div class="row">
            <div class="col-md-4">
                <div class="sidenav-dark">
                    <h6 style="color: white; padding-left: 10px; padding-bottom: 3px;padding-top: 3px;" >Consommation par Mois</h6>
                </div>
            </div>
            <div class="col-md-8">

            </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <canvas  class="consommation-annee" width="400" height="250"></canvas>
        </div>
        <div class="col-md-6">
           <canvas  class="consommation-annee-gazoil" width="400" height="250"></canvas>
        </div>
    </div>
    @endif
    @if($role === "chef sed")
        <div class="row">
            <div class="col-md-4">
                <div class="sidenav-dark">
                    <h6 style="color: white; padding-left: 10px; padding-bottom: 3px;padding-top: 3px;" >Consommation par trimestre</h6>
                </div>
            </div>
            <div class="col-md-8">

            </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <canvas  class="conso-trimestre" width="400" height="250"></canvas>
        </div>
        <div class="col-md-6">
            <canvas  class="conso-trimestre-gazoil" width="400" height="250"></canvas>
        </div>
    </div>
    @endif
    @if($role === "chef sed" || $role === "responsable station" || $role === "admin")
        <div class="row">
            <div class="col-md-4">
                <div class="sidenav-dark">
                    <h6 style="color: white; padding-left: 10px; padding-bottom: 3px;padding-top: 3px;" >Nombre de connexions des Agents</h6>
                </div>
            </div>
            <div class="col-md-8">

            </div>
        </div>
        <div class="row">
        <div class="col-md-10 offset-1">
            <canvas  class="connect" width="400" height="200"></canvas>
        </div>
        <div class="col-md-6"></div>
    </div>
    @endif




@endsection

@section('script')
    <script src="{{asset('js/Chart.min.js')}}"></script>
    <script>
        //les vartiables pour le graphe1
        let h1 = <?=$h1?>;
        let h2 = <?=$h2?>;
        let h3 = <?=$h3?>;
        let h4 = <?=$h4?>;
        let h5 = <?=$h5?>;
        let h6 = <?=$h6?>;
        let h7 = <?=$h7?>;
        let h8 = <?=$h8?>;
        let h9 = <?=$h9?>;
        let h10 = <?=$h10?>;
        let h11 = <?=$h11?>;
        let h12 = <?=$h12?>;
        let h13 = <?=$h13?>;
        let h14 = <?=$h14?>;
        let h15 = <?=$h15?>;
        let h16 = <?=$h16?>;
        let h17 = <?=$h17?>;
        let h18 = <?=$h18?>;
        let h19 = <?=$h19?>;
        let h20 = <?=$h20?>;
        let h21 = <?=$h21?>;
        let h22 = <?=$h22?>;
        let h23 = <?=$h23?>;
        let h24 = <?=$h24?>;
        let h25 = <?=$h25?>;
        let h26 = <?=$h26?>;
        let h27 = <?=$h27?>;
        let h28 = <?=$h28?>;
        let h29 = <?=$h29?>;
        let h30 = <?=$h30?>;
        let h31 = <?=$h31?>;

        let semaine1 =<?=$semaime1?>;
        let semaine2 =<?=$semaime2?>;
        let semaine3 =<?=$semaime3?>;
        let semaine4 =<?=$semaime4?>;

        let trimestre1 =<?=$trimestre1?>;
        let trimestre2 =<?=$trimestre2?>;
        let trimestre3 =<?=$trimestre3?>;
        let trimestre4 =<?=$trimestre4?>;

        let janvier = <?=$janvier?>;
        let fevrier = <?=$fevrier?>;
        let mars = <?=$mars?>;
        let avril = <?=$avril?>;
        let mai = <?=$mai?>;
        let juin = <?=$juin?>;
        let juillet = <?=$juillet?>;
        let aout = <?=$aout?>;
        let septembre = <?=$septembre?>;
        let octobre = <?=$octobre?>;
        let novembre = <?=$novembre?>;
        let decembre = <?=$decembre?>;

         let an = <?=$an?>;
        //les vartiables pour le graphe1
        let janvier12 = <?=$janvier12?>;
        let fevrier12 = <?=$fevrier12?>;
        let mars12 = <?=$mars12?>;
        let avril12 = <?=$avril12?>;
        let mai12 = <?=$mai12?>;
        let juin12 = <?=$juin12?>;
        let juillet12 = <?=$juillet12?>;
        let aout12 = <?=$aout12?>;
        let septembre12 = <?=$septembre12?>;
        let octobre12 = <?=$octobre12?>;
        let novembre12 = <?=$novembre12?>;
        let decembre12 = <?=$decembre12?>;

        //consommation par jour
        new Chart(document.getElementsByClassName("conso-jour"), {
            type: 'bar',
            data: {
                labels: ["1", "2", "3", "4", "5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31"],
                datasets: [
                    {
                        label: "Nombre de litres d'éssence consommé",
                        backgroundColor: ["#253279", "#2b9131","#877e28","#bc3838","#42c2c6","#b83ac1","#cec460","#180c2b","#1a5720","#523618","#c18adc","#734dc9","#253279", "#2b9131","#877e28","#bc3838","#42c2c6","#b83ac1","#cec460","#180c2b","#1a5720","#523618","##c18adc","#734dc9","#cec460","#180c2b","#1a5720","#523618","##c18adc","#734dc9"],
                        data: [h1,h2,h3,h4,h5,h6,h7,h8,h9,h10,h11,h12,h13,h14,h15,h16,h17,h18,h19,h20,h21,h22,h23,h24,h25,h26,h27,h28,h29,h30,h31]
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: "Consommation d'éssence par jour"
                }
            }
        });

        //consommation par semaine
        new Chart(document.getElementsByClassName("conso-semaine"), {
            type: 'bar',
            data: {
                labels: ["semaine 1", "semaine 2", "semaine 3", "semaine 4",],
                datasets: [
                    {
                        label: "nombre de litres consommé",
                        backgroundColor: ["#253279", "#b83ac1","#877e28","#bc3838"],
                        data: [semaine1,semaine2,semaine3,semaine4]
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: "Consommation d'éssence par semaine"
                }
            }
        });


        new Chart(document.getElementsByClassName("consommation-annee"), {
            type: 'bar',
            data: {
                labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre"],
                datasets: [
                    {
                        label: "nombre de litres d'éssence consommé",
                        backgroundColor: ["#253279", "#2b9131","#877e28","#bc3838","#42c2c6","#b83ac1","#cec460","#180c2b","#1a5720","#523618","##c18adc","#734dc9"],
                        data: [janvier,fevrier,mars,avril,mai,juin,juillet,aout,septembre,octobre,novembre,decembre]
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: "Consommation d'éssence par an essence"
                }
            }
        });

        //liste des agents connectés par moi
        new Chart(document.getElementsByClassName("connect"), {
            type: 'bar',
            data: {
                labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre"],
                datasets: [
                    {
                        label: "Les Agents Connectés",
                        backgroundColor: ["#253279", "#2b9131","#877e28","#bc3838","#42c2c6","#b83ac1","#cec460","#180c2b","#1a5720","#523618","##c18adc","#734dc9"],
                        data: [janvier12,fevrier12,mars12,avril12,mai12,juin12,juillet12,aout12,septembre12,octobre12,novembre12,decembre12]
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Année  '+an
                }
            }
        });

        //consommation par trimestre
        new Chart(document.getElementsByClassName("conso-trimestre"), {
            type: 'bar',
            data: {
                labels: ["Trimestre 1", "Trimestre 2", "trimestre 3", "Trimestre 4",],
                datasets: [
                    {
                        label: "Nombre de litres d'éssence consommé",
                        backgroundColor: ["#253279", "#b83ac1","#877e28","#bc3838"],
                        data: [trimestre1,trimestre2,trimestre3,trimestre4]
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Consommation essence par Trimestre'
                }
            }
        });


        //les vartiables pour le graphe1
        let h011 = <?=$h011?>;
        let h022 = <?=$h022?>;
        let h033 = <?=$h033?>;
        let h044 = <?=$h044?>;
        let h055 = <?=$h055?>;
        let h066 = <?=$h066?>;
        let h077 = <?=$h077?>;
        let h088 = <?=$h088?>;
        let h099 = <?=$h099?>;
        let h100 = <?=$h100?>;
        let h111 = <?=$h111?>;
        let h122 = <?=$h122?>;
        let h133 = <?=$h133?>;
        let h144 = <?=$h144?>;
        let h155 = <?=$h155?>;
        let h166 = <?=$h166?>;
        let h177 = <?=$h177?>;
        let h188 = <?=$h188?>;
        let h199 = <?=$h199?>;
        let h200 = <?=$h200?>;
        let h211 = <?=$h211?>;
        let h222 = <?=$h222?>;
        let h233 = <?=$h233?>;
        let h244 = <?=$h244?>;
        let h255 = <?=$h255?>;
        let h266 = <?=$h266?>;
        let h277 = <?=$h277?>;
        let h288 = <?=$h288?>;
        let h299 = <?=$h299?>;
        let h300 = <?=$h300?>;
        let h311 = <?=$h311?>;

        let semaine11 =<?=$semaime11?>;
        let semaine22 =<?=$semaime22?>;
        let semaine33 =<?=$semaime33?>;
        let semaine44 =<?=$semaime44?>;

        let trimestre11 =<?=$trimestre11?>;
        let trimestre22 =<?=$trimestre22?>;
        let trimestre33 =<?=$trimestre33?>;
        let trimestre44 =<?=$trimestre44?>;

        let janvier1 = <?=$janvier1?>;
        let fevrier1 = <?=$fevrier1?>;
        let mars1 = <?=$mars1?>;
        let avril1 = <?=$avril1?>;
        let mai1 = <?=$mai1?>;
        let juin1 = <?=$juin1?>;
        let juillet1 = <?=$juillet1?>;
        let aout1 = <?=$aout1?>;
        let septembre1 = <?=$septembre1?>;
        let octobre1 = <?=$octobre1?>;
        let novembre1 = <?=$novembre1?>;
        let decembre1 = <?=$decembre1?>;



        //consommation par jour
        new Chart(document.getElementsByClassName("conso-jour-gazoil"), {
            type: 'bar',
            data: {
                labels: ["1", "2", "3", "4", "5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31"],
                datasets: [
                    {
                        label: "Nombre de litres de gazoil consommé",
                        backgroundColor: ["#253279", "#2b9131","#877e28","#bc3838","#42c2c6","#b83ac1","#cec460","#180c2b","#c8c31a","#523618","#081443","#734dc9","#964b13", "#2b9131","#877e28","#bc3838","#42c2c6","#53310a","#67128b","#180c2b","#1a5720","#e32bc6","##c18adc","#734dc9","#cec460","#180c2b","#1a5720","#523618","##c18adc","#734dc9"],
                        data: [h011,h022,h033,h044,h055,h066,h077,h088,h099,h100,h111,h122,h133,h144,h155,h166,h177,h188,h199,h200,h211,h222,h233,h244,h255,h266,h277,h288,h299,h300,h311]
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Consommation du gazoil par jour'
                }
            }
        });

        //consommation par semaine
        new Chart(document.getElementsByClassName("conso-semaine-gazoil"), {
            type: 'bar',
            data: {
                labels: ["semaine 1", "semaine 2", "semaine 3", "semaine 4",],
                datasets: [
                    {
                        label: "nombre de litres de gazoil consommé",
                        backgroundColor: ["#67128b", "#122f8b","#13961e","#126d90"],
                        data: [semaine11,semaine22,semaine33,semaine44]
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Consommation de gazoil par semaine'
                }
            }
        });


        new Chart(document.getElementsByClassName("consommation-annee-gazoil"), {
            type: 'bar',
            data: {
                labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre"],
                datasets: [
                    {
                        label: "nombre de litres de gazoil consommé",
                        backgroundColor: ["#b29517", "#2b9131","#149b82","#bc3838","#ed7979","#b83ac1","#600f75","#180c2b","#1a5720","#126d90","#c18adc","#691bcd"],
                        data: [janvier1,fevrier1,mars1,avril1,mai1,juin1,juillet1,aout1,septembre1,octobre1,novembre1,decembre1]
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Consommation de gazoil par an'
                }
            }
        });


        //consommation par trimestre
        new Chart(document.getElementsByClassName("conso-trimestre-gazoil"), {
            type: 'bar',
            data: {
                labels: ["Trimestre 1", "Trimestre 2", "trimestre 3", "Trimestre 4",],
                datasets: [
                    {
                        label: "Nombre de litres de gazoil consommé",
                        backgroundColor: ["#31bee3", "#75c219","#a331e3","#ed7979"],
                        data: [trimestre11,trimestre22,trimestre33,trimestre44]
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Consommation de gazoil par Trimestre'
                }
            }
        });

    </script>
    <script type ="text/javascript">
        setTimeout(function() {
            location.reload();
        },120000);

    </script>

@endsection
