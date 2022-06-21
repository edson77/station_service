@extends('layouts.app')
@section('title', "Enregistrement")
@section('css')
    <style>

    </style>
@endsection

@section('content')
    <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
        <div class="container-fluid">
            <div class="page-header-content">

                <h5 class="page-header-subtitle">Consommation de carburant</h5>
                <ol class="breadcrumb mt-4 mb-0">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Acceuil</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('citerne.index')}}">Operations</a>/create</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-n10">
        <form   action="{{route('operation.store')}}" method="post">
            {{csrf_field()}}
            <div class="card">

                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <a id="addUser" type="button" class="btn btn-primary rounded-pill center" style="color: white;">Enregistrer le Client >><i class=""></i></a>
                         </div>
                     </div>
                </div>

                <div class="card-body" id="user" style="display: none;">
                    <div class="row">
                        <div class="col-md-8 offset-2" >

                                <h1 class="text-center">Enregistrer le client</h1>
                                <p>
                                    <label for="">Numero de la CNI *</label>
                                    <input id="cni" name="cni" placeholder="Entrez un numero de cni" class="form-control rounded-pill" >
                                </p>
                                <p>
                                    <label for="">Nom Complet *</label>
                                    <input name="nom" placeholder="Entrez un nom complet" class="form-control rounded-pill" >
                                </p>
                                <p>
                                    <label for="">Numero de Téléphone *</label>
                                    <input name="tel" placeholder="Entrez un numero de telephone" class="form-control rounded-pill" >
                                </p>
                                <p>
                                    <label for="">Grade *</label>
                                    <input name="grade" placeholder="Entrez un grade" class="form-control rounded-pill" >
                                </p>
                                <p>
                                    <label for="">Fonction *</label>
                                    <input name="fonction" placeholder="Entrez une fonction" class="form-control rounded-pill" >
                                </p>

                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">

                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <a id="addCar" type="button" class="btn btn-primary rounded-pill center" style="color: white;">Enregistrer le vehicule >><i class=""></i></a>
                        </div>
                    </div>
                </div>

                <div class="card-body" id="car" style="display: none;">
                    <div class="row">
                        <div class="col-md-8 offset-2" >
                            <h1 class="text-center">Enregistrer le vehicule</h1>
                            <p id="cni2">
                                <label for="">Propriétaire *</label>
                                <select name="cni2" id="cni2" class="form-control rounded-pill" >
                                    <option value="" selected="selected">Selectionner un client</option>
                                    @foreach($clients as $client)
                                        <option value="{{$client->numeroCNI}}">{{$client->nom}}</option>
                                    @endforeach
                                </select>

                            </p>
                            <p>
                                <label for="">Numéro d'Immatriculation</label>
                                <input id="immatriculation" name="immatriculation" placeholder="Entrez votre numéro d'immatriculation de votre vehicule" class="form-control rounded-pill" >
                            </p>
                            <p>
                                <label for="">Marque du vehicule *</label>
                                <input name="marque" placeholder="Entrez la marque de votre vehicule" class="form-control rounded-pill" >
                            </p>
                            <p>
                                <label for="">Modele du Vehicule *</label>
                                <input name="modele" placeholder="Entrez le modele de votre vehicule" class="form-control rounded-pill" >
                            </p>

                            <p>
                                <label for="">Type de Carburant *</label>
                                <select name="typeCarburant" id="" class="form-control rounded-pill" >
                                    <option value="essence">Essence</option>
                                    <option value="gazoil">Gazoil</option>
                                </select>

                            </p>


                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 offset-2">

                                <h1 class="text-center">Enregistrer une consommation</h1>
                                <p id="cni3">
                                    <label for="">Propriétaire *</label>
                                    <select name="cni3" id="cni3" class="form-control rounded-pill" >
                                        <option value="" selected="selected">Selectionner un client</option>
                                        @foreach($clients as $client)
                                            <option value="{{$client->numeroCNI}}">{{$client->nom}}</option>
                                        @endforeach
                                    </select>

                                </p>
                                <p id="voiture1">
                                    <label for="">Voiture *</label>
                                    <select name="matricule" id="matricule" class="form-control rounded-pill" >
                                        <option value="" selected="selected">Selectionner une Voiture</option>
                                        @foreach($voitures as $voiture)
                                            <option value="{{$voiture->immatriculation}}">{{$voiture->immatriculation}}</option>
                                        @endforeach
                                    </select>

                                </p>
                                <p>
                                    <label for="">Date de consommation</label>
                                    <input name="Dateconsommation"  type="date" class="form-control rounded-pill" >
                                </p>
                                <p>
                                    <label for="">Quantité de Carburant (en litre)</label>
                                    <input name="quantiteConsommation" placeholder="Entrez la quantité à consommer" class="form-control rounded-pill" >
                                </p>

                                <p>
                                    <label for="">Type de Carburabt à consommer *</label>
                                    <select name="typeCarburantConsommer" id="" class="form-control rounded-pill" >
                                        <option value="essence">Essence</option>
                                        <option value="gazoil">Gazoil</option>
                                    </select>

                                </p>
                                <p>
                                    <label for="">Montant de la consommation *</label>
                                    <input name="montantConso" placeholder="Entrez le Montant de la consommation" class="form-control rounded-pill" >
                                </p>
                                <p>
                                    <label for="">Choisir un mode de payement *</label>
                                    <select name="modePayement" id="mode" class="form-control rounded-pill" >
                                        <option value="espece">En Espèce</option>
                                        <option value="boncarburant">Par Bon de Carburant</option>
                                    </select>

                                </p>
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-8">

                                            <input style="border: 1px solid red; color: red; display: none;" id="bonid" name="bonid" placeholder="Entrez l'id du bon" class="form-control rounded-pill" >

                                    </div>
                                </div>
                                <p>
                                    <label for="">Choix de la citerne *</label>
                                    <select name="idciterne" id="" class="form-control rounded-pill" >
                                        <option value="essence">Essence</option>
                                        <option value="gazoil">Gazoil</option>
                                    </select>

                                </p>
                                <p>
                                    <label for="">Choisir la pompe *</label>
                                    <select name="pompe" id="" class="form-control rounded-pill" >
                                        <option value="pompe1">Pompe 1r</option>
                                        <option value="pompe2">Pompe 2</option>
                                    </select>

                                </p>

                                <p>
                                    <label for="">Identifier la station *</label>
                                    <select name="stationID" id="" class="form-control rounded-pill" >
                                        @foreach($stations as $station)
                                            <option value="{{$station->id}}">{{$station->adresse}}</option>
                                        @endforeach
                                    </select>

                                </p>
                                <button type="submit" class="btn btn-outline-primary rounded-pill">Soumettre</button>


                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>

        var user= document.getElementById("user");
        var addUser = document.getElementById("addUser");

        var car= document.getElementById("car");
        var addCar = document.getElementById("addCar");
        addUser.addEventListener('click', function () {
            let disp = user.style.display;
           // console.log(disp);
            if (disp == "block") {
                user.style.display= "none"
            }else{
                user.style.display= "block"
            }

        })

        addCar.addEventListener('click', function () {
            let disp = car.style.display;
           // console.log(disp);
            if (disp == "block") {
                car.style.display= "none"
            }else{
                car.style.display= "block"
            }

        })
        var cni = document.getElementById('cni')
        var cni2 = document.getElementById('cni2')
        var cni3 = document.getElementById('cni3')
        var immatriculation = document.getElementById('immatriculation')
        var voiture1 = document.getElementById('voiture1')
        var moveInput = function () {
            if (cni.value != ""){
                cni2.style.display = 'none';
                cni3.style.display = 'none';

            }else{
                cni2.style.display = 'block';
                cni3.style.display = 'block';
            }

            if (immatriculation.value != ""){
                voiture1.style.display = 'none';


            }else{
                voiture1.style.display = 'block';

            }

        }
        var i = 0

        setInterval(moveInput,5000)
        var mode = document.querySelector('#mode')
        var bonid = document.getElementById('bonid')
        var modeSelected = function () {
            if (mode.value == "boncarburant")
            {
                bonid.style.display = 'block';
            }else{
                bonid.style.display = 'none';
            }
        }
        setInterval(modeSelected,1000)

    </script>

@endsection