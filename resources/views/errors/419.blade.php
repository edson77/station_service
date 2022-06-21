@extends('layouts.erreurs')
@section('titre', "419")
@section('content')
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h3>la session a expiré</h3>
                <h1><span>4</span><span>1</span><span>9</span></h1>
            </div>
            <h2>Désolé, votre session a expiré. Veuillez actualiser et réessayer.</h2>
            <h2>
                <a style="text-decoration: none; color: blue" href="{{route('home')}}"><i class="arrow-left"></i>Revenir au tableau de bord</a>
            </h2>
        </div>
    </div>
@endsection