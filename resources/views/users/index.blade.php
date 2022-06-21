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
@extends('layouts.app')
@section('title', "Liste des utilisateurs")
@section('css')
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" crossorigin="anonymous" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" crossorigin="anonymous"></script>

@endsection

@section('content')
    <link rel="stylesheet" href="{{asset('js/jquery.dataTables.min.css')}}">


    <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
        <div class="container-fluid">
            <div class="page-header-content">

                <h5 class="page-header-subtitle">Information sur les utilisateurs</h5>
                <ol class="breadcrumb mt-4 mb-0">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Acceuil</a></li>
                    <li class="breadcrumb-item active">Utilisateurs</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-n10">
        <div class="card mb-4">
            <div class="card-header">
                <a href="{{route('user.print')}}" target="_blank" class="btn btn-primary">Imprimer</a>
            </div>

            <div class="card-body">
                <div class="datatable table-responsive">
                    <table id="data-table" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Email</th>
                            <th>Date de Naissance</th>
                            <th>Role</th>
                            <th>Modifier</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td><a href="{{route('user.show',$user->id)}}">{{$user->nom}}</a></td>
                            <td><a href="{{route('user.show',$user->id)}}">{{$user->prenom}}</a></td>
                            <td><a href="{{route('user.show',$user->id)}}">{{$user->mail}}</a></td>
                            <td><a href="{{route('user.show',$user->id)}}">{{$user->datenaissance}}</a></td>
                            <td>{{\App\Models\Privilege::find($user->id_privileges)->privilege}}</td>
                            <td>
                                <a href="{{route('user.show',$user->id)}}"class="btn btn-datatable btn-icon btn-transparent-dark mr-2" >
                                    <i data-feather="more-vertical"></i>
                                </a>

                                @if($role === "responsable station")
                                <button class="btn btn-datatable btn-icon btn-transparent-dark"  type="button" data-toggle="modal" data-target="#deleteModalCenter{{$user->id}}">
                                    <i data-feather="trash-2"></i>
                                </button>
                                <div class="modal fade" id="deleteModalCenter{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle{{$user->id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                voulez vous vraiment supprimer {{$user->nom}} {{$user->prenom}}
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Non</button>

                                                    <a class="btn btn-primary" href="{{route('user.delete',$user->id)}}">Oui</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach


                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#tableuser').DataTable();
        } );
    </script>

@endsection

