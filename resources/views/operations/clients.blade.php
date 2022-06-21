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
@section('title', "Liste des Clients")
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

                <h5 class="page-header-subtitle">Information sur les clients</h5>
                <ol class="breadcrumb mt-4 mb-0">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Acceuil</a></li>
                    <li class="breadcrumb-item active">Opérations</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-n10">
        <div class="card mb-4">
            <div class="card-header">
                <a href="{{route('clients.print')}}" target="_blank" class="btn btn-primary">Imprimer</a>
            </div>
            <div class="card-body">
                <div class="datatable table-responsive">
                    <table id="data-table" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Numero CNI</th>
                            <th>Nom complet du client</th>
                            <th>Grade</th>
                            <th>Fonction</th>
                            <th>Téléphone</th>
                            <th>Modifier</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>{{$client->numeroCNI}}</td>
                                <td>{{$client->nom}}</td>
                                <td>{{$client->grade}}</td>
                                <td>{{$client->fonction}}</td>
                                <td>{{$client->tel}}</td>
                                <td>

                                    @if($role === "agent pompiste" ||  $role === "responsable station")
                                        <button class="btn btn-datatable btn-icon btn-transparent-dark"  type="button" data-toggle="modal" data-target="#deleteModalCenter{{$client->numeroCNI}}">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="modal fade" id="deleteModalCenter{{$client->numeroCNI}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle{{$client->numeroCNI}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <form action="{{route('client.update',$client->numeroCNI)}}" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5>Modifier les informations du Client</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">

                                                            {{csrf_field()}}
                                                            <div class="form-group">
                                                                <label for="" class="">Nom Complet</label>
                                                                <input required="required" class="form-control" type="text" name="nom" value="{{$client->nom}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="" class="">Grade</label>
                                                                <input required="required" class="form-control" type="text" name="grade" value="{{$client->grade}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="" class="">Fonction</label>
                                                                <input required="required" class="form-control" type="text" name="fonction" value="{{$client->fonction}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="" class="">Téléphone</label>
                                                                <input required="required" class="form-control" type="text" name="tel" value="{{$client->tel}}">
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Ne pas modifier</button>

                                                        <button class="btn btn-primary" type="submit">Modifier</button>

                                                    </div>
                                                </div>
                                                </form>
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

