@extends('layouts.erreurs')
@section('titre', "401")
@section('content')
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h3>Accès non autorisé</h3>
                <h1><span>4</span><span>0</span><span>1</span></h1>
            </div>
            <h2>Vous ne pouvez pas accéder à l’adresse demandée.</h2>
            <h2>
                <a style="text-decoration: none; color: blue" href="{{route('home')}}"><i class="arrow-left"></i>Revenir au tableau de bord</a>
            </h2>
        </div>

    </div>
@endsection