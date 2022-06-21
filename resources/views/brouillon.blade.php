
<style>
    .twPc-div {
        background: #fff none repeat scroll 0 0;
        border: 1px solid #e1e8ed;
        border-radius: 6px;
        height: 200px;
        width: 100%; // orginal twitter width: 290px;
    }
    .twPc-bg {
        background-image: url("/img/twitter01.jpg");
        background-position: 0 50%;
        background-size: 100% auto;
        border-bottom: 1px solid #e1e8ed;
        border-radius: 4px 4px 0 0;
        height: 100px;
        width: 100%;
    }
    .twPc-block {
        display: block !important;
    }

    .twPc-avatarLink {
        background-color: #fff;
        border-radius: 6px;
        display: inline-block !important;
        float: left;
        margin: -50px 5px 0 8px;
        max-width: 100%;
        padding: 1px;
        vertical-align: bottom;
    }
    .twPc-avatarImg {
        border: 2px solid #fff;
        border-radius: 7px;
        box-sizing: border-box;
        color: #fff;
        height: 90px;
        width: 90px;
    }
    .twPc-divUser {
        margin: 5px 0 0;
    }
    .twPc-divName {
        font-size: 18px;
        font-weight: 700;
        line-height: 21px;
    }
    .twPc-divName a {
        color: inherit !important;
    }



    .twPc-ArrangeSizeFit a:hover {
        text-decoration: none;
    }
    .cacher{
        display: none;
    }

</style>


<!--  <div class="container">
        <div class="row">

            <div class="col-md-12">
                <!-- code start -->
<div class="twPc-div">
    <a class="twPc-bg twPc-block"></a>

    <div>


        <a title="Mert S. Kaplan" href="https://twitter.com/mertskaplan" class="twPc-avatarLink">
            <img alt="Mert S. Kaplan" src="{{url('uploads/avatar/'.$user->avatar)}}" class="twPc-avatarImg">
        </a>

        <div class="twPc-divUser">
            <div class="twPc-divName">
                <a href="https://twitter.com/mertskaplan">{{$user->nom}} {{$user->prenom}}</a>
            </div>
        </div>


    </div>
</div>
<!-- code end -->
</div>

</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center"> Informations </h2>
            </div>
            <div class="card-body">
                <h5>Nom: <strong>{{$user->nom}}</strong></h5>
                <h5>Prenom: <strong>{{$user->prenom}}</strong></h5>
                <h5>Date de Naissance: <strong>{{$user->datenaissance}}</strong></h5>
                <h5>Email: <strong>{{$user->mail}}</strong></h5>
            </div>
            <div class="card-footer">
                <button id="monbouton" type="button" class="btn btn-primary">Modifier les informations</button>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card cacher" id="cacher">
            <div class="card-header">
                <h2 class="text-center"> Modifier </h2>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('user.update',$user->id)}}" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="">Nom *</label>
                        <input type="text" name="nom" value="{{$user->nom}}" class="form-control" placeholder="Entrez un Nom">
                    </div>
                    <div class="form-group">
                        <label for="">Prénom *</label>
                        <input name="prenom" type="text" value="{{$user->prenom}}" class="form-control" placeholder="Entrez un prenom">
                    </div>
                    <div class="form-group">
                        <label for="">Email *</label>
                        <input name="email" type="email" class="form-control" value="{{$user->mail}}" placeholder="Entrez un Email">
                    </div>

                    <div class="form-group">
                        <label for="">Image de Profil *</label>
                        <input name="avatar" type="file" class="form-control" placeholder="Selectionner un avatar">
                    </div>


                    <div class="form-group">
                        <label for="">Mot de passe *</label>
                        <input name="password" type="password" class="form-control" placeholder="Entrez un Mot de passe">
                    </div>



                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <span>Modifier le profil</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>-->
