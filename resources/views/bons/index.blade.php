@extends('layouts.app')
@section('title', "Bons")
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

                <h5 class="page-header-subtitle">Information sur les bons de carburant</h5>
                <ol class="breadcrumb mt-4 mb-0">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Acceuil</a></li>
                    <li class="breadcrumb-item active">Bons</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-n10">
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-10">
                        <form class="form-inline" action= "{{route('bons.search.post')}}" method="post" >
                            {{csrf_field()}}
                            <div class="form-group mr-2">
                                <label for="email-3" class="sr-only">Catégorie</label>
                                <select class="form-control form-control-sm" name="categorie" id="simple-select">
                                    <option selected="selected" value="">Choisir une catégorie</option>
                                    @foreach($categories  as $bon)
                                        <option value="{{$bon->categorie}}">{{$bon->categorie}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mr-2">
                                <label for="email-3" class="sr-only">Choisir par Montant</label>
                                <select class="form-control form-control-sm" name="montant" id="simple-select">
                                    <option selected="selected" value="">Trier par Montant</option>
                                    @foreach($montants  as $bon)
                                        <option value="{{$bon->montant}}">{{$bon->montant}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mr-2">
                                <label for="email-3" class="sr-only">Choisir par date de délivrance</label>
                                <select class="form-control form-control-sm" name="localite" id="simple-select">
                                    <option selected="selected" value="">Choisir par localité</option>
                                    @foreach($localites  as $bon)
                                    <option value="{{$bon->localite}}">{{$bon->localite}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <a href="{{route('bon.print')}}"   target="_blank" class="btn btn-primary btn-sm">  Imprimer la liste</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-body">
                <div class="datatable table-responsive">
                    <table id="data-table" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Catégorie</th>
                            <th>Date de délivrance</th>
                            <th>propriétaire</th>
                            <th>Montant</th>
                            <th>Localité</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bons as $bon)
                            <tr>

                                <td><a href="#">{{$bon->categorie}}</a></td>
                                <td><a href="#">{{$bon->date_bon}}</a></td>
                                <td><a href="#">{{$bon->nom}}</a></td>
                                <td>{{$bon->montant}} FCFA</td>
                                <td>{{$bon->localite}}</td>
                                <td>
                                    <a href="{{route('bon.show',$bon->identifiant)}}"class="btn btn-datatable btn-icon btn-transparent-dark mr-2" >
                                        <i data-feather="more-vertical"></i>
                                    </a>


                                    <button class="btn btn-datatable btn-icon btn-transparent-dark"  type="button" data-toggle="modal" data-target="#deleteModalCenter{{$bon->identifiant}}">
                                        <i data-feather="trash-2"></i>
                                    </button>
                                    <div class="modal fade" id="deleteModalCenter{{$bon->identifiant}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle{{$bon->identifiant}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    voulez vous vraiment supprimer cette information?
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Non</button>

                                                    <a class="btn btn-primary" href="{{route('bon.delete',$bon->identifiant)}}">Oui</a>

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

