@extends('layouts.app')
@section('title',"consomation-$consommations->id")
<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

$Authprivileges = DB::table('privileges')
    ->select('privilege')
    ->join('users', 'privileges.id', '=', 'users.id_privileges')
    ->where('users.id','=', Auth::user()->id)
    ->get();
$role = $Authprivileges[0]->privilege;

?>
@section('css')
    <style>

        .emp-profile{
            padding: 3%;
            margin-top: 3%;
            margin-bottom: 3%;
            border-radius: 0.5rem;
            background: #fff;
        }
        .profile-img{
            text-align: center;
        }
        .profile-img img{
            width: 70%;
            height: 100%;
        }
        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -20%;
            width: 70%;
            border: none;
            border-radius: 0;
            font-size: 15px;
            background: #212529b8;
        }
        .profile-img .file input {
            position: absolute;
            opacity: 0;
            right: 0;
            top: 0;
        }
        .profile-head h5{
            color: #333;
        }
        .profile-head h6{
            color: #0062cc;
        }
        .profile-edit-btn{
            border: none;
            border-radius: 1.5rem;
            width: 70%;
            padding: 2%;
            font-weight: 600;
            color: #6c757d;
            cursor: pointer;
        }
        .proile-rating{
            font-size: 12px;
            color: #818182;
            margin-top: 5%;
        }
        .proile-rating span{
            color: #495057;
            font-size: 15px;
            font-weight: 600;
        }
        .profile-head .nav-tabs{
            margin-bottom:5%;
        }
        .profile-head .nav-tabs .nav-link{
            font-weight:600;
            border: none;
        }
        .profile-head .nav-tabs .nav-link.active{
            border: none;
            border-bottom:2px solid #0062cc;
        }
        .profile-work{
            padding: 14%;
            margin-top: -15%;
        }
        .profile-work p{
            font-size: 12px;
            color: #818182;
            font-weight: 600;
            margin-top: 10%;
        }
        .profile-work a{
            text-decoration: none;
            color: #495057;
            font-weight: 600;
            font-size: 14px;
        }
        .profile-work ul{
            list-style: none;
        }
        .profile-tab label{
            font-weight: 600;
        }
        .profile-tab p{
            font-weight: 600;
            color: #0062cc;
        }
    </style>
@endsection

@section('content')
    <div class="container emp-profile">


        <div class="row">
            <div class="col-md-4">
                <div class="profile-work">

                </div>
            </div>
            <div class="col-md-8" style="border: 5px solid black; border-radius: 5px;">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h1>INFORMATIONS SUR LA CONSOMMATION</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nom du Client</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{\App\Models\Client::where('numeroCNI',$consommations->numeroCNI)->first()->nom}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Numéro de la CNI</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$consommations->numeroCNI}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Fonction</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{\App\Models\Client::where('numeroCNI',$consommations->numeroCNI)->first()->fonction}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Grade</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{\App\Models\Client::where('numeroCNI',$consommations->numeroCNI)->first()->grade}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>N° de Téléphone</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{\App\Models\Client::where('numeroCNI',$consommations->numeroCNI)->first()->tel}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Immatriculation du véhicule</label>
                            </div>
                            <div class="col-md-6">
                                    <p>{{\App\Models\Voiture::where('immatriculation',$consommations->immatriculation)->first()->immatriculation}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Marque du véhicule</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{\App\Models\Voiture::where('immatriculation',$consommations->immatriculation)->first()->marque}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Modèle du véhicule</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{\App\Models\Voiture::where('immatriculation',$consommations->immatriculation)->first()->modele}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Date Consommation</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$consommations->date_consomation}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Type de Carburant</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$consommations->typeCarburant}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Quantité de Carburant( en litre)</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$consommations->quantite_carburant}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Montant Consommation</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$consommations->montant_consomation}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Mode de payement</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$consommations->modepayement}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Localité</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{\Illuminate\Support\Facades\DB::table('station_service')->where('id',$consommations->id_station_service)->first()->adresse}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{route('conso.print.id',$consommations->id)}}" target="_blank" class="btn btn-primary">Imprimer</a>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){

            $('#monbouton').click(function(){
                $('#cacher').show()}
            );

            $('#afficher').cllick(function(){
                    $('#cacher').hide();
                }
            )

        });

    </script>
@endsection