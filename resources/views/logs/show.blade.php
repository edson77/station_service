@extends('layouts.app')
@section('title', "Log")
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

                <h5 class="page-header-subtitle">Détail du journal</h5>
                <ol class="breadcrumb mt-4 mb-0">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Acceuil</a></li>
                    <li class="breadcrumb-item active">Fichiers de journalisation/detail</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-n10">
        <div class="card mb-4">

            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-2" style="background-color: #e9e9e9; margin: 10px">
                        <h3>AUTEUR :</h3>
                        <p> {{\App\User::find($log->auteur)->nom}}&nbsp;{{\App\User::find($log->auteur)->prenom}}</p>

                        <h3>LIBELLE :</h3>
                        <p>{{$log->libelle}}</p>

                        <h3>LE :</h3>
                        <p>{{$log->created_at}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 offset-2" style="margin: 10px">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary">Imprimer</button>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
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

