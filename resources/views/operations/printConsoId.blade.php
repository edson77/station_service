<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Les utilisateurs</title>
    <style type="text/css">
        <!--
        .Style1 {font-family: Georgia, "Times New Roman", Times, serif;
            color: white;
            padding-top: 5px;
            padding-bottom: 5px;
        }
        .Style4 {font-family: Georgia, "Times New Roman", Times, serif; font-weight: bold; font-size: 16px; }
        .Style8 {
            font-size: 24px;
            font-weight: bold;
        }
        .Style9 {font-size: 12px; font-weight: normal}
        .Style10 {
            font-size: 14px;
            font-weight: bold;
        }
        .Style11 {
            font-size: 14px;
            font-family: Georgia, "Times New Roman", Times, serif;
        }
        .Style13 {font-size: 16px}
        -->
    </style>
</head>

<body>
<div>
    <table width="100%" border="0">
        <tr>
            <th width="48%" scope="col"><div align="center">REPUBLIQUE DU CAMEROUN</div></th>
            <th width="13%" rowspan="8" scope="col">
                <img src="img/nation.png" width="100" height="100" />
            </th>
            </th>
            <th width="48%" scope="col"><div align="center">REPUBLIC OF CAMEROON</div></th>
        </tr>
        <tr>
            <th scope="row" class="Style9"><div align="center">Paix-Travail-Patrie</div></th>
            <th scope="row" class="Style9"><div align="center">Peace-Work-Fatherland</div></th>
        </tr>
    </table>
    <br>
    <p align="center" class="Style4"><span class="Style8">Informations sur une consommation </span></p>
    <div style="display: block;padding-left: 300px;">

        <table style="right: 10%; left: 10%" width="70%" border="2"  cellspacing="0">
            <tr border="0">

                <td>
                    <p><strong>Nom</strong>:&nbsp;{{\App\Models\Client::where('numeroCNI',$consommations->numeroCNI)->first()->nom}}</p><br>
                    <p ><strong>Numéro de la CNI</strong>:&nbsp; {{$consommations->numeroCNI}}</p><br>
                    <p ><strong>Fonction</strong>:&nbsp; {{\App\Models\Client::where('numeroCNI',$consommations->numeroCNI)->first()->fonction}}</p><br>
                    <p ><strong>Grade</strong>:&nbsp; {{\App\Models\Client::where('numeroCNI',$consommations->numeroCNI)->first()->grade}}</p><br>
                    <p ><strong>N° de Téléphone</strong>:&nbsp; {{\App\Models\Client::where('numeroCNI',$consommations->numeroCNI)->first()->tel}}</p><br>
                    <p ><strong>Immatriculation du véhicule</strong>:&nbsp; {{\App\Models\Voiture::where('immatriculation',$consommations->immatriculation)->first()->immatriculation}}</p><br>
                    <p ><strong>Marque du véhicule</strong>:&nbsp; {{\App\Models\Voiture::where('immatriculation',$consommations->immatriculation)->first()->marque}}</p><br>
                    <p ><strong>Modèle du véhicule</strong>:&nbsp; {{\App\Models\Voiture::where('immatriculation',$consommations->immatriculation)->first()->modele}}</p><br>
                    <p ><strong>Date Consommation</strong>:&nbsp; {{$consommations->date_consomation}}</p><br>
                    <p ><strong>Type de Carburant</strong>:&nbsp; {{$consommations->typeCarburant}}</p><br>
                    <p ><strong>Quantité de Carburant( en litre)</strong>:&nbsp; {{$consommations->quantite_carburant}}</p><br>
                    <p ><strong>Montant Consommation</strong>:&nbsp; {{$consommations->montant_consomation}} FCFA</p><br>
                    <p ><strong>Mode de payement</strong>:&nbsp; {{$consommations->modepayement}}</p><br>
                    <p ><strong>Localité</strong>:&nbsp; {{\Illuminate\Support\Facades\DB::table('station_service')->where('id',$consommations->id_station_service)->first()->adresse}}</p><br>
                </td>
            </tr>
        </table>
    </div>

    <table width="40%" border="0" align="right">
        <tr align="left">
            <th  scope="col"><div align="left"><span class="Style1">Fait par: {{Auth::user()->nom}} {{Auth::user()->prenom}}  le:  {{NOW()->format('d/m/Y')}} </span></div></th>
        </tr>
    </table>
</body>
</html>
