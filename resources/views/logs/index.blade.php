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

                <h5 class="page-header-subtitle">Information sur les fichiers de journalisation</h5>
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
                <div class="row">
                    <div class="col-10">
                        <form class="form-inline" action= "{{route('logs.search.post')}}" method="post" >
                            {{csrf_field()}}
                            <div class="form-group mr-4">
                                <label for="email-3" class="sr-only">Catégorie</label>
                                <select class="form-control form-control-sm" name="auteur" id="simple-select">
                                    <option selected="selected" value="">Choisir par Auteur</option>
                                    @foreach($auteurs as $auteur)
                                         <option  value="{{$auteur->auteur}}">{{\App\User::find($auteur->auteur)->nom}}&nbsp;{{\App\User::find($auteur->auteur)->prenom}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mr-4">
                                <label for="email-3" class="sr-only">Choisir par Date</label>
                                <select class="form-control form-control-sm" name="jour" id="simple-select">
                                    <option selected="selected" value="">Trier par date</option>
                                    @foreach($jours as $jour)
                                        <option  value="{{$jour->jour}}">{{$jour->jour}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group ml-3">
                                <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <a href="{{route('log.print')}}"   target="_blank" class="btn btn-primary btn-sm">  Imprimer la liste</a>
                        </div>
                    </div>

                </div>
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

