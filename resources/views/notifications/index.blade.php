@extends('layouts.app')
@section('title', "Notifications")
@section('css')
    <style>

    </style>
@endsection

@section('content')
    <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
        <div class="container-fluid">
            <div class="page-header-content">

                <h5 class="page-header-subtitle">Toutes les Notifications</h5>
                <ol class="breadcrumb mt-4 mb-0">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Acceuil</a></li>
                    <li class="breadcrumb-item active">/Notifications</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-n10">
        <div class="card">

            <div class="card-body">

                    @foreach($notifications as $notification)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">

                                <div class="col-md-12">
                                    <a class="dropdown-item dropdown-notifications-item" href="#!">
                                        <div class="dropdown-notifications-item-icon ">
                                            <i data-feather="bell"></i>
                                        </div>
                                        <div class="dropdown-notifications-item-content">
                                            <div class="dropdown-notifications-item-content-details">{{$notification->created_at}}</div>
                                            <div class="dropdown-notifications-item-content-text">{{$notification->message}}</div>
                                        </div>
                                    </a>
                                </div>


                            </div>

                        </div>
                    </div>
                    <br>
                    @endforeach

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>



    </script>
@endsection