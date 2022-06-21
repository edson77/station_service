@extends('layouts.erreurs')
@section('titre', "500")
@section('content')
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h3>Erreur Interne du Serveur</h3>
                <h1><span>5</span><span>0</span><span>0</span></h1>
            </div>
            <h2>le systeme est incapable de vous fournir les informations demandées</h2>
            <h2>
                <a style="text-decoration: none; color: blue" href="{{route('home')}}"><i class="arrow-left"></i>Revenir au tableau de bord</a>
            </h2>
        </div>
    </div>
@endsection