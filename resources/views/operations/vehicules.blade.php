@extends('layouts.app')
@section('title', "Liste des Voitures")
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

                <h5 class="page-header-subtitle">Information sur les voitures</h5>
                <ol class="breadcrumb mt-4 mb-0">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Acceuil</a></li>
                    <li class="breadcrumb-item active">Voitures</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-n10">
        <div class="card mb-4">
            <div class="card-header">
                <a href="{{route('vehicules.print')}}" target="_blank" class="btn btn-primary">Imprimer</a>
            </div>

            <div class="card-body">
                <div class="datatable table-responsive">
                    <table id="data-table" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Immatriculation</th>
                            <th>Marquet</th>
                            <th>Modèle</th>
                            <th>Type de Carburant</th>
                            <th>Propriétaire</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($voitures as $voiture)
                            <tr>
                                <td>{{$voiture->immatriculation}}</td>
                                <td>{{$voiture->marque}}</td>
                                <td>{{$voiture->modele}}</td>
                                <td>{{$voiture->typeCarburant}}</td>
                                <td>{{\App\Models\Client::where('numeroCNI',$voiture->numeroCNI)->first()->nom}}</td>
                                <td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#tableclient').DataTable();
        } );
    </script>

@endsection

