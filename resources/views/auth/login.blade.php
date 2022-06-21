<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content />
    <meta name="author" content />
    <title>Connexion</title>
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <script data-search-pseudo-elements defer src="{{asset('js/all.min.js')}}" crossorigin="anonymous"></script>
    <script src="{{asset('js/feather.min.js')}}" crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" ></script>
    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet'>
    <style>
        .h-color{
            color: white;
            font-weight: bold;
            font-size: 43px;
            position: relative;
            top : 60%;
            margin-bottom: 50px;
        }
        .card{
            border-radius: 0px;
        }
    </style>
</head>
<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center h-color">ADMINISTRATION</h1>
                    </div>
                </div>
                <div class="row justify-content-center">

                    <div class="col-lg-5">
                        <div class="card border-0 mt-5">
                            <div class="card-body">
                                <form method="post" action="{{route('post.login')}}">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label class="small mb-1" for="identifiant">Identifiant</label>
                                        <input required="required" class="form-control py-4" name="identifiant" id="identifiant" type="text" placeholder="Entrer un identifiant" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="mdp">Mot de passe</label>
                                        <input required="required" class="form-control py-4" name="mdp" id="mdp" type="password" placeholder="Entrer un mot de passe" />
                                    </div>
                                    <div class="form-group">
                                       <!-- <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                            <label class="custom-control-label" for="rememberPasswordCheck">Se souvenir de moi</label>
                                        </div>-->
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a style="display: none;" class="small" href="#">Mot de passe oublié?</a>
                                        <button class="btn btn-primary" type="submit">Connexion</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="footer mt-auto footer-dark">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 small">Copyright SED&#xA9;{{date('Y')}}</div>
                    <div class="col-md-6 text-md-right small">
                        <a href="#!">Propriété privée</a>
                        &#xB7;
                        <a href="#!">Conditions &amp; d'utilisation</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="{{asset('js/jquery.min.js')}}" crossorigin="anonymous"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}" crossorigin="anonymous"></script>
<script src="{{asset('js/bootstrap.min.js')}}" crossorigin="anonymous"></script>
<script src="{{asset('js/scripts.js')}}"></script>
@include('flashy::message')


</body>
</html>
