<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

$Authprivileges = DB::table('privileges')
    ->select('privilege')
    ->join('users', 'privileges.id', '=', 'users.id_privileges')
    ->where('users.id','=', Auth::user()->id)
    ->get();
$role = $Authprivileges[0]->privilege;


$notificationsNonLus = DB::select("SELECT * FROM notifications WHERE received = :received AND unread ='0'",
    [
        'received'=> Auth::user()->id,
    ]);
$notifications = DB::select("SELECT * FROM notifications WHERE received = :received ORDER BY created_at DESC LIMIT 3 ",
    [
        'received'=> Auth::user()->id,
    ]);

$notifsNonLus = count($notificationsNonLus);
//dd($notifsNonLus);
// les informations sur la comptabilité
    $recettes =DB::select("SELECT 
    SUM(recettes) total
    FROM transactions");
    $recette = (double)($recettes[0]->total);


    $depenses =DB::select("SELECT 
    SUM(depenses) total
    FROM transactions");
    $depense =(double)($depenses[0]->total);
    $solde = (double)($recettes[0]->total) - (double)($depenses[0]->total);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="{{asset('img/sed.ico')}}" type="image/x-icon">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content />
    <meta name="author" content />
    <title>@yield('title') - Dashbord</title>

    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/jquery-ui.js')}}"></script>
    <script data-search-pseudo-elements defer src="{{asset('js/all.min.js')}}" ></script>
    <script src="{{asset('js/feather.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" ></script>
    <link rel="stylesheet" href="{{asset('css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/datepicker.min.css')}}">
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
    <link href="{{asset('css/loader.css')}}" rel="stylesheet" />
    <!--<link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet'>-->
    @yield('css')
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
    </script>
    <style>
        .badge{
            min-height: 15px;
            min-width: 15px;
            font-size: 10px;

            border: solid 1px white;
            border-radius: 50%;
            text-align: center;
        }
    </style>
</head>
<body onload="loaderJS()" class="nav-fixed">

<div id="loader"></div>

<div style="display:none;" id="myDiv" class="animate-bottom">
    <nav class="topnav navbar navbar-expand shadow navbar-light sidenav-dark" id="sidenavAccordion">
        <a class="navbar-brand d-none d-sm-block" href="{{route('home')}}">
            <span style="color: white">Tableau De Bord</span>
        </a>
        <!--<button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle" href="#">
            <i style="color: white" data-feather="menu"></i>
        </button>-->
        <!--<form class="form-inline mr-auto d-none d-lg-block">
            <input class="form-control form-control-solid mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
        </form> -->
        <ul class="navbar-nav align-items-center ml-auto">
            <!--
            les document
            <li class="nav-item dropdown no-caret mr-3">
                <a class="nav-link dropdown-toggle" id="navbarDropdownDocs" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                ><div class="d-inline d-md-none font-weight-500">Docs</div>
                    <div class="d-none d-md-inline font-weight-500">Documentation</div>
                    <i class="fas fa-chevron-right dropdown-arrow"></i
                    ></a>
                <div class="dropdown-menu dropdown-menu-right py-0 o-hidden mr-n15 mr-lg-0 animated--fade-in-up" aria-labelledby="navbarDropdownDocs">
                    <a class="dropdown-item py-3" href="https://docs.startbootstrap.com/sb-admin-pro" target="_blank"
                    ><div class="icon-stack bg-primary-soft text-primary mr-4"><i data-feather="book"></i></div>
                        <div>
                            <div class="small text-gray-500">Documentation</div>
                            Usage instructions and reference
                        </div></a
                    >
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item py-3" href="https://docs.startbootstrap.com/sb-admin-pro/components" target="_blank"
                    ><div class="icon-stack bg-primary-soft text-primary mr-4"><i data-feather="code"></i></div>
                        <div>
                            <div class="small text-gray-500">Components</div>
                            Code snippets and reference
                        </div></a
                    >
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item py-3" href="https://docs.startbootstrap.com/sb-admin-pro/changelog" target="_blank"
                    ><div class="icon-stack bg-primary-soft text-primary mr-4"><i data-feather="file-text"></i></div>
                        <div>
                            <div class="small text-gray-500">Changelog</div>
                            Updates and changes
                        </div></a
                    >
                </div>
            </li> -->
            <li class="nav-item dropdown no-caret mr-3 dropdown-notifications">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i style="color: white;" data-feather="bell"></i>
                    @if($notifsNonLus > 0)
                    <sup><span id="notif"><span class="badge badge-danger">{{$notifsNonLus}}</span></span></sup>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownAlerts">
                    <h6 class="dropdown-header dropdown-notifications-header"><i class="mr-2" data-feather="bell"></i>
                        Liste des Notifications
                    </h6>
                    <a href="{{route('notifications.isRead')}}" class="text-center" >
                        <i data-feather="trash-2"></i>
                        Marquer comme lu
                    </a>

                    @foreach($notifications as $notification)
                        @if($notification->unread = "0")
                            <a class="dropdown-item dropdown-notifications-item" href="#!" style="background-color:#a4a4a4; ">
                                <div class="dropdown-notifications-item-icon bg-warning" style="background-color:#a4a4a4;">
                                    <i data-feather="bell"></i>
                                </div>
                                <div class="dropdown-notifications-item-content" style="background-color:#a4a4a4;">
                                    <div class="dropdown-notifications-item-content-details">{{$notification->created_at}}</div>
                                    <div class="dropdown-notifications-item-content-text">{{$notification->message}}</div>
                                </div>
                            </a>
                        @else
                            <a class="dropdown-item dropdown-notifications-item" href="#!">
                                <div class="dropdown-notifications-item-icon bg-warning">
                                    <i data-feather="bell"></i>
                                </div>
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-details">{{$notification->created_at}}</div>
                                    <div class="dropdown-notifications-item-content-text">{{$notification->message}}</div>
                                </div>
                            </a>
                        @endif

                    @endforeach
                    <a class="dropdown-item dropdown-notifications-footer" href="{{route('notifications')}}">Voir toutes les notifications</a>
                </div>
            </li>

            <!--
            partie messages de l'appli
            <li class="nav-item dropdown no-caret mr-3 dropdown-notifications">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownMessages" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="mail"></i></a>
                <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownMessages">
                    <h6 class="dropdown-header dropdown-notifications-header"><i class="mr-2" data-feather="mail"></i>Message Center</h6>
                    <a class="dropdown-item dropdown-notifications-item" href="#!"
                    ><img class="dropdown-notifications-item-img" src="https://source.unsplash.com/vTL_qy03D1I/60x60" />
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                            <div class="dropdown-notifications-item-content-details">Emily Fowler &#xB7; 58m</div>
                        </div></a
                    ><a class="dropdown-item dropdown-notifications-item" href="#!"
                    ><img class="dropdown-notifications-item-img" src="https://source.unsplash.com/4ytMf8MgJlY/60x60" />
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                            <div class="dropdown-notifications-item-content-details">Diane Chambers &#xB7; 2d</div>
                        </div></a
                    ><a class="dropdown-item dropdown-notifications-footer" href="#!">Read All Messages</a>
                </div>
            </li> -->
            <!-- pour le user connecté -->
            <li class="nav-item dropdown no-caret mr-3 dropdown-user">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" style="border-radius: 50%; height: 35px; width: 35px;" src="{{url('uploads/avatar/'.\Illuminate\Support\Facades\Auth::user()->avatar)}}"/></a>
                <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img" src="{{url('uploads/avatar/'.\Illuminate\Support\Facades\Auth::user()->avatar)}}" />
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name">{{\Illuminate\Support\Facades\Auth::user()->prenom}} {{\Illuminate\Support\Facades\Auth::user()->nom}}</div>
                            <div class="dropdown-user-details-email">{{\Illuminate\Support\Facades\Auth::user()->mail}}</div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('user.show.auth')}}">
                        <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                        Mon Compte</a>
                    <a class="dropdown-item" href="{{route('logout')}}"
                    ><div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Déconnexion</a
                    >
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sidenav shadow-right sidenav-dark">
                <div class="sidenav-menu">
                    <div class="nav accordion" id="accordionSidenav">
                     <!--   <div class="sidenav-menu-heading">Menus</div>-->

                    @if( $role === "admin" || $role === "responsable station" || $role === "chef sed")
                        <!-- debut partie gestion des utilisateurs     -->
                            <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="false" aria-controls="collapseUsers">
                                <div class="nav-link-icon"><i data-feather="folder"></i>
                                </div>
                                Gestion des Utilisateurs
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            @if($role === "admin")
                            <div class="collapse" id="collapseUsers" data-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav"><a class="nav-link" href="{{route('user.create')}}"><i data-feather="user-plus"></i>&nbsp;Ajouter</a></nav>
                            </div>
                            @endif

                            <div class="collapse" id="collapseUsers" data-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav"><a class="nav-link" href="{{route('user.index')}}"><i data-feather="eye"></i>&nbsp;Consulter</a></nav>
                            </div>
                            @if($role === "admin" || $role === "responsable station")
                            <div class="collapse" id="collapseUsers" data-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav"><a class="nav-link" href="{{route('user.deleted')}}"><i data-feather="eye-off"></i>&nbsp;Supprimer</a></nav>
                            </div>
                            @endif
                            <!-- fin partie gestion des utilisateurs     -->
                    @endif

                    @if( $role === "responsable station" || $role === "agent pompiste" || $role === "chef sed")
                    <!-- debut partie gestion des operations     -->
                        <a id="pere" class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseOperation" aria-expanded="false" aria-controls="collapseOperation">
                            <div class="nav-link-icon"><i data-feather="folder"></i>
                            </div>
                            Operations
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        @if($role === "agent pompiste" || $role === "responsable station")
                        <div class="collapse" id="collapseOperation" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav"><a class="nav-link" href="{{route('operation.create')}}"><i data-feather="plus"></i>&nbsp;Ajouter</a></nav>
                        </div>
                        @endif
                        <div class="collapse" id="collapseOperation" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link collapsed" href="javascript:void(1);" data-toggle="collapse" data-target="#collapseSousOperation" aria-expanded="false" aria-controls="collapseSousOperation">
                                    <div class="nav-link-icon"><i data-feather="folder"></i>
                                    </div>
                                    Consulter
                                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseSousOperation" data-parent="#pere">
                                    <nav class="sidenav-menu-nested nav"><a class="nav-link" href="{{route('consommation.index')}}"><i data-feather="eye"></i>&nbsp;Consommations</a></nav>
                                </div>
                                @if($role === "agent pompiste" || $role === "responsable station")
                                <div class="collapse" id="collapseSousOperation" data-parent="#pere">
                                    <nav class="sidenav-menu-nested nav"><a class="nav-link" href="{{route('conso.deleted')}}"><i data-feather="eye-off"></i>&nbsp;Supprimer</a></nav>
                                </div>

                                <div class="collapse" id="collapseSousOperation" data-parent="#pere">
                                    <nav class="sidenav-menu-nested nav"><a class="nav-link" href="{{route('consommation.clients')}}"><i data-feather="eye"></i>&nbsp;Clients</a></nav>
                                </div>
                                <div class="collapse" id="collapseSousOperation" data-parent="#pere">
                                    <nav class="sidenav-menu-nested nav"><a class="nav-link" href="{{route('consommation.vehicules')}}"><i data-feather="eye"></i>&nbsp;vehicules</a></nav>
                                </div>
                                @endif

                            </nav>
                        </div>

                        <!-- fin partie gestion des operations     -->
                    @endif

                    @if( $role === "agent pompiste")
                        <!-- debut partie gestion des citernes    -->
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseCiternes" aria-expanded="false" aria-controls="collapseCiternes">
                            <div class="nav-link-icon"><i data-feather="folder"></i>
                            </div>
                            Citernes
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseCiternes" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav"><a class="nav-link" href="{{route('citerne.create')}}"><i data-feather="plus"></i>&nbsp;Ajouter</a></nav>
                        </div>
                        <div class="collapse" id="collapseCiternes" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav"><a class="nav-link" href="{{route('citerne.index')}}"><i data-feather="eye"></i>&nbsp;Consulter</a></nav>
                        </div>
                        <!-- fin partie gestion des citernes     -->

                    @endif

                    @if( $role === "responsable station" || $role === "chef sed")
                        <!-- debut partie gestion des bons de carburant     -->
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseBon" aria-expanded="false" aria-controls="collapseBon">
                            <div class="nav-link-icon"><i data-feather="folder"></i>
                            </div>
                            Gestion Des Bons
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        @if($role === "responsable station")
                        <div class="collapse" id="collapseBon" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav"><a class="nav-link" href="{{route('bon.create')}}"><i data-feather="plus"></i>&nbsp;Attribuer</a></nav>
                        </div>
                        @endif
                        <div class="collapse" id="collapseBon" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav"><a class="nav-link" href="{{route('bons')}}"><i data-feather="eye"></i>&nbsp;Consulter</a></nav>
                        </div>
                        <div class="collapse" id="collapseBon" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav"><a class="nav-link" href="{{route('bons.deleted')}}"><i data-feather="eye-off"></i>&nbsp;Supprimer</a></nav>
                        </div>
                        <div class="collapse" id="collapseBon" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav"><a class="nav-link" href="{{route('bons.used')}}"><i data-feather="eye-off"></i>&nbsp;Deja Consommé</a></nav>
                        </div>
                        <!-- fin partie gestion des bons de carburant     -->
                    @endif
                    @if( $role === "chef sed" || $role === "admin")
                        <a class="nav-link" href="{{route('logs')}}">
                            <div class="nav-link-icon"><i data-feather="file-text"></i></div>
                            Fichiers de journalisations
                        </a>
                    @endif
                        <!--
                        <div class="sidenav-menu-heading">Comptabilité de l'entreprise</div>
                        @if( $role === "responsable station")
                        <a class="nav-link" type="button" data-toggle="modal" data-target="#IntroduireDesCapitaux">
                            <div class="nav-link-icon"><i data-feather="dollar-sign"></i></div>
                            Introduire des capitaux
                        </a>
                        @endif
                        <div class="nav-link">Solde : {{$solde}}</div>
                        <div class="nav-link">Entrées : {{$recette}}</div>
                        <div class="nav-link">Depenses : {{$depense}}</div>
                        -->
                    </div>
                </div>
                <div class="sidenav-footer">
                    <div class="sidenav-footer-content">
                        <div class="sidenav-footer-subtitle">Enregistrer en tant que:</div>
                        <div class="sidenav-footer-title">{{\Illuminate\Support\Facades\Auth::user()->nom}} &nbsp; {{\Illuminate\Support\Facades\Auth::user()->prenom}}
                            <br> (<span style="color: yellow;">{{\App\Models\Privilege::find(\Illuminate\Support\Facades\Auth::user()->id_privileges)->privilege}}</span>)&nbsp;<span  id="enligne" style="color: #1dc819; display: inline-block;">en ligne</span></div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- introduction d'un modal -->
            <div class="modal fade" id="IntroduireDesCapitaux" tabindex="-1" role="dialog" aria-labelledby="IntroduireDesCapitauxTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <form methode="post" action="{{route('solde.post')}}">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="IntroduireDesCapitauxTitle">Injecter des dévises dans votre structure</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                                
                                    {{csrf_field()}}

                                <div class="form-group">
                                    <label for="">Montant</label>
                                    <input type="text" name="montant" class="form-control" placeholder="Entrez un montant">
                                </div>
                                    
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Fermer</button>
                                <button class="btn btn-primary" type="submit">Injecter</button></div>
                        </div>
                    </form>
                </div>
            </div>
        <!-- introduction d'un modal -->

        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
            <footer class="footer mt-auto footer-light">
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
</div>

<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>

<script src="{{asset('js/datepicker.js')}}" ></script>
<script src="{{asset('js/datepicker.fr.js')}}" ></script>
<script src="{{asset('js/main.js')}}"></script>

<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/data-table.js')}}"></script>


@include('flashy::message')
@yield('script')
<script>
   var enligne = document.getElementById('enligne');

   var blink = function () {
       if (enligne.style.display == "block") {
           enligne.style.display = "none"
       }else {
           enligne.style.display = "block"
       }
   }
   setInterval(blind,1000)
    var myVar;

    function loaderJS() {
        myVar = setTimeout(showPage, 2000);
    }

    function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("myDiv").style.display = "block";
    }
    var navbarDropdownAlerts = document.getElementById('navbarDropdownAlerts');
    
    navbarDropdownAlerts.addEventListener('click', function () {
        document.getElementById("notif").innerHTML =""
    })
</script>
</body>
</html>
