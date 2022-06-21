@extends('layouts.app')
@section('title', "Livraison Carburant")
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

                <h5 class="page-header-subtitle">Approvisionnement de la citerne en carburant</h5>
                <i style="color: yellow; font-size: 11px;">(la capacité maximale des citernes est de 100 000 litres chacune)</i>
                <ol class="breadcrumb mt-4 mb-0">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Acceuil</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('citerne.index')}}">citerne</a>/create</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-n10">
        <div class="card">

            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-2">
                        <form method="post" action="{{route('citerne.store')}}" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="">Nom de la Compagnie</label>
                                <input required="required" type="text" name="compagnie" class="form-control" placeholder="Entrez le nom de la compagnie">
                            </div>
                            <div class="form-group">
                                <label for="">Quantité livrée (<i>en litre</i>) </label>
                                <input required="required" name="quantite" type="text" class="form-control" placeholder="Entrez la quantité livrée">
                            </div>
                            <div class="form-group">
                                <label for="">Montant à payer (en FCFA)</label>
                                <input required="required" name="montant" type="text" class="form-control" placeholder="Entrez le montant que vous allez payer">
                            </div>
                            <div class="form-group">
                                <label for="">Type de Carburants</label>
                                <select name="typecarburant" type="text" class="form-control">
                                    <option value="essence">Essence</option>
                                    <option value="gazoil">Gazoil</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Date de Livraison</label>
                                <input required="required" name="datelivraison" type="date" class="form-control" >
                            </div>



                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary rounded-pill">
                                    <span>Approvisionnement</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
