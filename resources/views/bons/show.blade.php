@extends('layouts.app')
@section('title',"consomation-$bon->identifiant-RDKLSpkldsjP")
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
                        <h1>INFORMATIONS SUR LE BON</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nom du Propriétaire</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$bon->nom}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Catégorie</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$bon->categorie}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Montant</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $bon->montant}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Localité</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$bon->localite}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Code du bon</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$bon->identifiant}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Date de délivrance</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$bon->date_bon}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Status</label>
                            </div>
                            <div class="col-md-6">
                                @if($bon->status == 0)
                                    <p style="color: #1dc819;">Valide</p>
                                @endif
                                @if($bon->status == 1)
                                    <p style="color: #e29820;">Consommé</p>
                                @endif
                                @if($bon->status == 2)
                                    <p style="color: red;">Supprimé</p>
                                @endif

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Déscription</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{$bon->libelle}}</p>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{route('bon.print.id',$bon->identifiant)}}" target="_blank" class="btn btn-primary">Imprimer</a>
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