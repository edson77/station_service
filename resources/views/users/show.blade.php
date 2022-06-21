@extends('layouts.app')
@section('title', $user->slug)
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
        body{
            background-color: #8e8e8e;
            background-image: linear-gradient(135deg, #071a3d 0%, rgba(0, 0, 0, 26) 90%);
        }
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
                    <div class="profile-img">
                        <img src="{{url('uploads/avatar/'.$user->avatar)}}" alt=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5>
                            {{$user->prenom}} &nbsp; {{$user->nom}}
                        </h5>
                        <h6>
                            {{$privilege}}
                        </h6>
                        <p class="proile-rating"><!--RANKINGS : <span>8/10</span>--></p>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Informations</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Plus</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    @if($role == "admin")
                        <a class="btn btn-outline-primary rounded-pill" href="" type="button" data-toggle="modal" data-target="#deleteModalCenter">Modifier</a>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-work">

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Identifiant</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->identifiant}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Nom & Prenom</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->nom}} {{$user->prenom}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->mail}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Telephone</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->phone}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Date de Naissance</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->datenaissance}}</p>
                                </div>
                            </div>
                        </div>
                       <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                 <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{route('user.print.id',$user->id)}}" target="_blank" class="btn btn-primary rounded-pill">imprimer</a>
                                    </div>

                                </div>
                               <!-- <div class="row">
                                    <div class="col-md-6">
                                        <label>Hourly Rate</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>10$/hr</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Total Projects</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>230</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>English Level</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Expert</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Availability</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>6 months</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Your Bio</label><br/>
                                        <p>Your detail description</p>
                                    </div>
                                </div>-->
                            </div>
                    </div>
                </div>
            </div>
        <!-- debut du model pour modifier le profil d'un user -->
        <div class="modal fade" id="deleteModalCenter" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{route('user.update',$user->id)}}" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="">Nom *</label>
                                <input type="text" name="nom" value="{{$user->nom}}" class="form-control" placeholder="Entrez un Nom">
                            </div>
                            <div class="form-group">
                                <label for="">Prénom *</label>
                                <input name="prenom" type="text" value="{{$user->prenom}}" class="form-control" placeholder="Entrez un prenom">
                            </div>
                            <div class="form-group">
                                <label for="">Email *</label>
                                <input name="email" type="email" class="form-control" value="{{$user->mail}}" placeholder="Entrez un Email">
                            </div>
                            <div class="form-group">
                                <label for="">Identifiant *</label>
                                <input name="identifiant" type="text" value="{{$user->identifiant}}" class="form-control" placeholder="Entrez un identifiant">
                            </div>

                            <div class="form-group">
                                <label for="">Image de Profil *</label>
                                <input name="avatar" type="file" class="form-control" placeholder="Selectionner un avatar">
                            </div>


                            <div class="form-group">
                                <label for="">Mot de passe *</label>
                                <input name="password" type="password" class="form-control" placeholder="Entrez un Mot de passe">
                            </div>



                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <span>Modifier le profil</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">


                    </div>
                </div>
            </div>
        </div>
        <!-- fin du le model pour modifier le profil d'un user -->
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