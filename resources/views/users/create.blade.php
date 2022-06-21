@extends('layouts.app')
@section('title', "Créer un utilisateur")
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
                <h5 class="page-header-subtitle">Ajouter un utilisateur dans le systeme!</h5>
                <ol class="breadcrumb mt-4 mb-0">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Acceuil</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('user.index')}}">Utilisateurs</a>/create</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-n10">
        <div class="card">

            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-2">
                        <form method="post" action="{{route('user.store')}}" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <label for="">Nom *</label>
                                    <input required="required" type="text" name="nom" class="form-control" placeholder="Entrez un Nom">
                                </div>
                                <div class="form-group">
                                    <label for="">Prénom *</label>
                                    <input required="required" name="prenom" type="text" class="form-control" placeholder="Entrez un prenom">
                                </div>
                                <div class="form-group">
                                    <label for="">Identifiant <span style="color: red">(unique)</span>*</label>
                                    <input name="identifiant" type="text" class="form-control" placeholder="Entrez un Identifiant">
                                </div>
                                <div class="form-group">
                                    <label for="">Email *</label>
                                    <input required="required" name="email" type="email" class="form-control" placeholder="Entrez un Email">
                                </div>

                                <div class="form-group">
                                    <label for="">Image de Profil *</label>
                                    <input  name="avatar" type="file" class="form-control" placeholder="Selectionner un avatar">
                                </div>

                                <div class="form-group">
                                    <label for="">Date de naissance *</label>
                                    <span class="lnr "></span>
                                    <input required="required" name="datenaissance" type="text" class="form-control datepicker-here" data-language='fr' data-date-format="dd M yyyy" id="dp2">
                                </div>
                                <div class="form-group">
                                    <label for="">Numéro de Téléphone *</label>
                                    <input required="required" name="phone" type="text" class="form-control" placeholder="Entrez le numero de téléphone">
                                </div>

                                <div class="form-group">
                                    <label for="">Role *</label>
                                    <select name="id_privileges" id="" class="form-control">
                                        <option value="null">Choisiser un role</option>
                                        @foreach($privileges as $privilege)
                                            <option value="{{$privilege->id}}">{{$privilege->privilege}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Mot de passe *</label>
                                    <input required="required" name="password" type="text" class="form-control" placeholder="Entrez un Mot de passe">
                                </div>
                                


                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary rounded-pill">
                                    <span>Creer Utilisateur</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
