@extends('layouts.app')
@section('title', "Carburant")
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

                <h5 class="page-header-subtitle">resultats de la recherche</h5>
                <ol class="breadcrumb mt-4 mb-0">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Acceuil</a></li>
                    <li class="breadcrumb-item active">citernes</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-n10">
        <div class="card mb-4">
            <div class="card-header">
                <h1>resultats de la recherche</h1>
            </div>

            <div class="card-body">
                <div class="datatable table-responsive">
                    <table id="data-table" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>date_livraison</th>
                            <th>type_carburant</th>
                            <th>quantiteLivree</th>
                            <th>compagnie</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($citernes as $citerne)
                            <tr>
                                <td><a href="#">{{$citerne->id}}</a></td>
                                <td><a href="#">{{$citerne->date_livraison}}</a></td>
                                <td><a href="#">{{$citerne->type_carburant}}</a></td>
                                <td><a href="#">{{$citerne->quantiteLivree}}</a></td>
                                <td>{{$citerne->compagnie}}</td>
                                <td>
                                    <a href="#"class="btn btn-datatable btn-icon btn-transparent-dark mr-2" >
                                        <i data-feather="more-vertical"></i>
                                    </a>


                                    <button class="btn btn-datatable btn-icon btn-transparent-dark"  type="button" data-toggle="modal" data-target="#deleteModalCenter{{$citerne->id}}">
                                        <i data-feather="trash-2"></i>
                                    </button>
                                    <div class="modal fade" id="deleteModalCenter{{$citerne->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle{{$citerne->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">??</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    voulez vous vraiment supprimer cette information?
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Non</button>

                                                    <a class="btn btn-primary" href="{{route('citerne.delete',$citerne->id)}}">Oui</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

