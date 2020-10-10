@extends('../layouts.admin')
@section('content')         

     
{{--     <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
 --}}


    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">Profile</h3>

        </div>

        <div class="" id="ici_le_msg" style="text-align: center;">

            

            {{--  --}}
        </div>

    </div>

    <!-- ============================================================== -->

    <!-- End Bread crumb and right sidebar toggle -->

    <!-- ============================================================== -->

    <button class="btn btn-success" id="modifiermotdepasse" style="margin: 2% 0%;"> Modifier Mot de passe</button>



    <button class="btn btn-success" id="modifierinformations" style="margin: 2% 0%;">Mes informations</button>



    <!-- ============================================================== -->

    <!-- Start Page Content -->

    <!-- ============================================================== -->

    <!-- Row -->

    <div class="row">

        <!-- Column -->

        <div class="col-lg-4 col-xlg-3 col-md-5">

            <div class="card">

                <div class="card-body">

                    <center class="m-t-30"> <img src="img/logo.svg" alt="LE LOGO" width="50%"  width="150" />

                        <h4 class="card-title m-t-10">{!! $actuel->name !!} </h4>

                        <h6 class="card-subtitle">{!! $actuel->prenom !!} </h6>


                    </center>

                </div>

            </div>

        </div>

        <!-- Column -->

        <!-- Column -->

        <div class="col-lg-8 col-xlg-9 col-md-7" id="password">

            <div class="card">

                <div class="card-body">

                    <form class="form-horizontal form-material">

                        {{ csrf_field() }}

                        <div class="form-group">    

                            <label class="col-md-12">Mot de passe actuel </label>

                            <div class="col-md-12">

                                <input type="password" name="ancien_password" value="password" class="form-control form-control-line">

                            </div>

                        </div>


                        <div class="form-group">

                            <label class="col-md-12">Nouveau Mot de passe</label>

                            <div class="col-md-12">

                                <input type="password" id="password1" name="password" v-model="passeword" value="password" class="form-control form-control-line">

                            </div>

                        </div>


                        <div class="form-group">

                            <label class="col-md-12">Confirmer le Nouveau Mot de passe</label>

                            <div class="col-md-12">

                                <input type="password" id="password_confirmation" name="password_confirmation" value="password" class="form-control form-control-line">

                            </div>

                        </div>



                        <div class="form-group">

                            <div class="col-sm-12">

                                <button class="btn btn-success" onclick="modifierlemotdepasse(event)">Modifier le mot de passe</button>

                            </div>

                        </div>

                    </form>

                    {{--  --}}
                </div>

            </div>

        </div>


        <div class="col-lg-8 col-xlg-9 col-md-7" id="informations">

            <div class="card">

                <div class="card-body">



                    <h4>Informations personnelles</h4>

                    <hr>

                    <form class="form-horizontal form-material">

                        {{ csrf_field() }}

                        <div class="form-group">

                            <label class="col-md-12">Nom : {!! $actuel->name !!}</label>
                        </div>



                        <div class="form-group">

                            <label class="col-md-12">Prénom : {!! $actuel->prenom !!}</label>


                        </div>


                        <div class="form-group">

                            <label class="col-md-12">Num tel : {!! $actuel->numtel !!}</label>


                        </div>

                        <div class="form-group">

                            <label class="col-md-12">Email : {!! $actuel->email !!}</label>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Column -->
    </div>

   <script src="{{ asset('../js/jquery-3.2.1.min.js') }}"></script>



   <script src="{{ asset('../js/modifiermotdepasse.js') }}"></script>    





    <!-- ============================================================== -->

</div>





@endsection