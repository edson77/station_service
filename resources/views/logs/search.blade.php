@extends('layouts.app')
@section('title', "fichiers de journalisation")
@section('css')
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <!-- <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />-->
    <!-- <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" crossorigin="anonymous"></script>-->

@endsection

@section('content')
    <link rel="stylesheet" href="{{asset('js/jquery.dataTables.min.css')}}">


    <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
        <div class="container-fluid">
            <div class="page-header-content">

                <h5 class="page-header-subtitle">Resultat de la recherche</h5>
                <ol class="breadcrumb mt-4 mb-0">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Acceuil</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('logs')}}">Logs</a></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-n10">
        <div class="card mb-4">
            <div class="card-header">
                <h3>resultat de la recherche</h3>
            </div>
            <div class="card-body">
                <div class="datatable table-responsive">
                    <table id="data-table" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Libéllé</th>
                            <th>Creation</th>
                            <th>Auteur</th>
                            <th>Modifier</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td><a href="{{route('logs.show',$log->id)}}">{{$log->id}}</a></td>
                                <td><a href="{{route('logs.show',$log->id)}}">{{$log->libelle}}</a></td>
                                <td><a href="{{route('logs.show',$log->id)}}">{{$log->created_at}}</a></td>
                                <td><a href="{{route('logs.show',$log->id)}}">{{\App\User::find($log->auteur)->nom}}&nbsp;{{\App\User::find($log->auteur)->prenom}}</a></td>
                                <td>
                                    <a href="{{route('logs.show',$log->id)}}"class="btn btn-datatable btn-icon btn-transparent-dark mr-2" >
                                        <i data-feather="more-vertical"></i>
                                    </a>
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

