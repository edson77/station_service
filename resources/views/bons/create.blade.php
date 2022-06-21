@extends('layouts.app')
@section('title', "Create user")
@section('css')
    <style>
        .form-control{
            border-radius: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
        <div class="container-fluid">
            <div class="page-header-content">

                <h5 class="page-header-subtitle">Attribution des bons de carburant</h5>
                <ol class="breadcrumb mt-4 mb-0">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Acceuil</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('bons')}}">Bons</a></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-n10">
        <div class="card">

            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-2">
                        <form method="post" autocomplete="off" action="{{route('bon.store')}}" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="">Catégorie</label>
                                <input required="required" type="text" name="categorie" class="form-control" placeholder="Entrez la Categorie">
                            </div>
                            <div class="form-group">
                                <label for="">Date de délivrance du Bon </label>
                                <input required="required" name="delivrance" type="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Localité</label>
                                <input required="required" name="localite" type="text" class="form-control" placeholder="Entrez la Localité">
                            </div>
                            <div class="form-group">
                                <label for="">Nom du Propriétaire</label>
                                <input required="required" name="nom" type="text" class="form-control" placeholder="Entrez le nom du propriétaire">
                            </div>
                            <div class="form-group">
                                <label for="">Montant (en chiffres)</label>
                                <input required="required" name="montant" type="text" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="">Commentaire</label>
                                <textarea name="libelle" class="form-control"></textarea>
                            </div>



                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary rounded-pill">
                                    <span>Attribuer le Bon</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
