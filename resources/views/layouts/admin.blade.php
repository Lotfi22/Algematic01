<!DOCTYPE html>

<html lang="en">

<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Tell the browser to be responsive to screen width -->

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">

    <!-- Favicon icon -->

    <link rel="icon" type="image/svg" sizes="16x16" href="{{ asset('../img/logo.svg') }}">

    <title>Welcome Admin</title>

    <!-- Bootstrap Core CSS -->

    <script src="{{ asset('../js/jquery-3.2.1.min.js') }}"></script>

    <link href="{{ asset('../nabila/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- This page CSS -->

    <link href="{{ asset('../nabila/assets/plugins/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">

    
    <link href="{{ asset('../nabila/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">

    <!--c3 CSS -->

    <link href="{{ asset('../nabila/assets/plugins/c3-master/c3.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->

    <link href="{{ asset('../nabila/lite/css/style.css') }}" rel="stylesheet">

    <!-- Dashboard 1 Page CSS -->

    <link href="{{ asset('../nabila/lite/css/pages/dashboard.css') }}" rel="stylesheet">

    <!-- You can change the theme colors from here -->

    <link href="{{ asset('../nabila/lite/css/colors/default-dark.css') }}" id="theme" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('../DataTables/datatables.min.css') }}"/>

     <link rel="stylesheet" type="text/css" href="{{ asset('../Nimi/nimi.css') }}"/>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

<![endif]-->

</head>



<body id="body" class="fix-header fix-sidebar card-no-border">

    <!-- ============================================================== -->

    <!-- Preloader - style you can find in spinners.css -->

    <!-- ============================================================== -->

    <div class="preloader">

        <div class="loader">

            <div class="loader__figure"></div>

            <p class="loader__label">Algematic</p>

        </div>

    </div>

    <!-- ============================================================== -->

    <!-- Main wrapper - style you can find in pages.scss -->

    <!-- ============================================================== -->

    <div id="main-wrapper" >

        <!-- ============================================================== -->

        <!-- Topbar header - style you can find in pages.scss -->

        <!-- ============================================================== -->

        <header class="topbar">

            <nav class="navbar top-navbar navbar-expand-md navbar-light">

                <!-- ============================================================== -->

                <!-- Logo -->

                <!-- ============================================================== -->

                <div class="navbar-header">

                    <a class="navbar-brand" href="">

                        <!-- Logo icon --><b>

                            <img width="50%" src="{{ asset('../nabila/assets/images/algematic.png') }}" alt="homepage" class="dark-logo" />

                        </b>

                        <!--End Logo icon -->

                        <!-- Logo text -->
                    </a>

                </div>

                <!-- ============================================================== -->

                <!-- End Logo -->

                <!-- ============================================================== -->

                <div class="navbar-collapse">

                    <!-- ============================================================== -->

                    <!-- toggle and nav items -->

                    <!-- ============================================================== -->

                    <ul class="navbar-nav mr-auto">

                        <!-- This is  -->

                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>

                    </ul>

                    <!-- ============================================================== -->

                    <!-- User profile and search -->

                    <!-- ============================================================== -->

                    <ul class="navbar-nav my-lg-0">

                        <!-- ============================================================== -->

                        <!-- Search -->

                        <!-- ============================================================== -->

                        {{--<li class="nav-item hidden-xs-down search-box"> 

                             <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i> 

                            <form class="app-search">

                                <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a>

                            </form>

                        </li>--}} 


                        <!-- ============================================================== -->

                        <!-- Profile -->

                        <!-- ============================================================== -->

                        <li class="nav-item">

                            <a class="nav-link waves-effect waves-dark" onclick="event.preventDefault();

                                document.getElementById('logoutform').submit();" href="{{ url('/logout') }}"><img src="{{ asset('../nabila/assets/images/1.jpg') }}" alt="user" class="profile-pic" />

                            </a>



                            <form id="logoutform" action="{{ url('/logout') }}" method="POST" style="display: none;">

                                {{ csrf_field() }}

                            </form>



                            {{--  --}}                            

                        </li>

                    </ul>

                </div>

            </nav>

        </header>

        <!-- ============================================================== -->

        <!-- End Topbar header -->

        <!-- ============================================================== -->

        <!-- ============================================================== -->

        <!-- Left Sidebar - style you can find in sidebar.scss  -->

        <!-- ============================================================== -->

        <aside style="height: 100%; overflow: scroll;" class="left-sidebar">

            <!-- Sidebar scroll-->

            <div class="scroll-sidebar">

                <!-- Sidebar navigation-->

                <nav class="sidebar-nav">

                    <ul id="sidebarnav">

                        <li> <a class="waves-effect waves-dark" href="/home" aria-expanded="false"><i class="mdi mdi-account-check"></i><span class="hide-menu">Profile</span></a></li>


                        <li> <a id="stocks" class="waves-effect waves-dark" href="/home4" onclick="fshow(event)" aria-expanded="false"><i class="mdi mdi-arrow-down-drop-circle-outline"></i><span class="hide-menu">Stock</span></a></li>


                        <li class="acacher"> <a class="waves-effect waves-dark" href="/home/stocks/depot" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Dépot</span></a></li>

                        <li class="acacher"> <a class="waves-effect waves-dark" href="/home/stocks/local" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Local</span></a></li>

                        <li class="acacher"> <a class="waves-effect waves-dark" href="/home/stocks/rayon" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Rayon</span></a></li>

                        <li class="acacher"> <a class="waves-effect waves-dark" href="/home/stocks/etagere" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Etagère</span></a></li>

                        <li class="acacher"> <a class="waves-effect waves-dark" href="/home/stocks/ProduitStock" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Produits</span></a></li>
                        
                        {{-- fin stock --}}                        

                        <li> <a id="produits" class="waves-effect waves-dark" href="/home4" onclick="fshowProduit(event)" aria-expanded="false"><i class="mdi mdi-arrow-down-drop-circle-outline"></i><span class="hide-menu">Produit</span></a></li>


                        <li class="acacherProduit"> <a class="waves-effect waves-dark" href="/home/produits/categorie" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Catégorie</span></a></li>

                        <li class="acacherProduit"> <a class="waves-effect waves-dark" href="/home/produits/familleProd" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Famille</span></a></li>

                        <li class="acacherProduit"> <a class="waves-effect waves-dark" href="/home/produits/sousFamille" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Sous Famille</span></a></li>

                    

                        <li class="acacherProduit"> <a class="waves-effect waves-dark" href="/home/produits/unite" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Unité de Mesure</span></a></li>

                        <li class="acacherProduit"> <a class="waves-effect waves-dark" href="/home/produits/produit" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Mes Produits</span></a></li>


                        {{-- fin produit --}}

                        <li> <a id="fournisseurs" class="waves-effect waves-dark" href="/home4" onclick="fshow2(event)" aria-expanded="false"><i class="mdi mdi-arrow-down-drop-circle-outline"></i><span class="hide-menu">Fournisseur</span></a></li>


                        <li class="acacher2"> <a class="waves-effect waves-dark" href="/home/fournisseurs/fournisseur" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Mes Fournisseurs</span></a></li>


                        {{-- fin fournisseur --}}                        



                        <li> <a id="achats" class="waves-effect waves-dark" href="/home4" onclick="DemandeAchat(event)" aria-expanded="false"><i class="mdi mdi-arrow-down-drop-circle-outline"></i><span class="hide-menu" >Achat</span></a></li>



                        <li class="DemandeAchat"> <a class="waves-effect waves-dark" href="/home/achats/DemandeAchatPrestation" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Demande d'Achat</span></a></li>


                        <li class="DemandeAchat"> <a class="waves-effect waves-dark" href="/home/achats/DemandeAttente2" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Approbation</span></a></li>

                        <li class="DemandeAchat"> <a class="waves-effect waves-dark" href="/home/achats/AchatArrivage" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Arrivage</span></a></li>

                        <li class="DemandeAchat"> <a class="waves-effect waves-dark" href="/home/achats/Rangement" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Rangement</span></a></li>
                        
                        {{-- fin achat --}}

                        <li> <a class="waves-effect waves-dark" id="clients" href="/home4" onclick="fshow3(event)" aria-expanded="false"><i class="mdi mdi-arrow-down-drop-circle-outline"></i><span class="hide-menu">Client</span></a></li>


                        <li class="acacher3"> <a class="waves-effect waves-dark" href="/home/clients/categorie" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Catégorie</span></a></li>

                        <li class="acacher3"> <a class="waves-effect waves-dark" href="/home/clients/activite" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Activité</span></a></li>

                        <li class="acacher3"> <a class="waves-effect waves-dark" href="/home/clients/prospectes" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Clients | Prospect</span></a></li>

                        {{-- fin client --}}                                                                                        

                        <!--Fin-->

                        <li> <a id="vente" class="waves-effect waves-dark" href="/home4" onclick="DemandeVente(event)" aria-expanded="false"><i class="mdi mdi-arrow-down-drop-circle-outline"></i><span class="hide-menu">Vente</span></a></li>


                        <li class="DemandeVente"> <a class="waves-effect waves-dark" href="/home/vente/article" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Article de Vente</span></a></li>

                        <li class="DemandeVente"> <a class="waves-effect waves-dark" href="/home/vente/DemandeVente" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Demande de Vente</span></a></li>

                        
                        <li class="DemandeVente"> <a class="waves-effect waves-dark" href="/home/vente/DemandeVenteAttente" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Mes PréVentes</span></a></li>    
                        <hr>

                        @if( $privilege ?? '' == 1 )
                        <li> <a id="parametres" class="waves-effect waves-dark" href="/home4" onclick="Parametre(event)" aria-expanded="false"><i class="mdi mdi-arrow-down-drop-circle-outline"></i><span class="hide-menu">Paramètre</span></a></li>


                        <li class="Parametre"> <a class="waves-effect waves-dark" href="/home/parametres/TypeDocument" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Type Document</span></a></li>
                        @endif

                        {{-- fin fournisseur --}}                     

                        <li>



                            <a href="{{ url('/logout') }}"

                                onclick="event.preventDefault();

                                         document.getElementById('logout-form').submit();">

                                <i class="mdi mdi-logout"></i> Se déconnecter

                            </a>



                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">

                                {{ csrf_field() }}

                            </form>

                        </li>                    



                    </ul>



                    {{--  --}}

                </nav>

                <!-- End Sidebar navigation -->

            </div>

            <!-- End Sidebar scroll-->

        </aside>

        <!-- ============================================================== -->

        <!-- End Left Sidebar - style you can find in sidebar.scss  -->

        <!-- ============================================================== -->

        <!-- ============================================================== -->

        <!-- Page wrapper  -->

        <!-- ============================================================== -->


        @if ((session()->has('notification.message')))

          

            <div class="alert alert-{{ session()->get('notification.type') }}" style="text-align: center;">

            

                {{ session()->get('notification.message') }}

            </div>



          {{--  --}}

        @endif               


        <div class="page-wrapper" >


            <div class="container-fluid">


                <div id="ici_message" class="alert alert-success" style="text-align: center;">

                </div>


                @if ((session()->has('notification.message')))

                  

                    <div class="alert alert-{{ session()->get('notification.type') }}" style="text-align: center;">
                    

                        {{ session()->get('notification.message') }}

                    </div>


                  {{--  --}}
                @endif               



                @yield('content')



                {{--  --}}
            </div>    
        </div>
    </div>





    <!-- ============================================================== -->

    <!-- End Wrapper -->

    <!-- ============================================================== -->

    <!-- ============================================================== -->

    <!-- All Jquery -->

    <!-- ============================================================== -->

    <script src="{{ asset('../nabila/assets/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('../nabila/assets/plugins/bootstrap/js/popper.min.js') }}"></script>

    <script src="{{ asset('../nabila/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('../nabila/lite/js/perfect-scrollbar.jquery.min.js') }}"></script>

    <script src="{{ asset('../nabila/lite/js/waves.js') }}"></script>

    <script src="{{ asset('../nabila/lite/js/sidebarmenu.js') }}"></script>

    <script src="{{ asset('../nabila/lite/js/custom.min.js') }}"></script>

    <script src="{{ asset('../nabila/assets/plugins/chartist-js/dist/chartist.min.js') }}"></script>

    <script src="{{ asset('../nabila/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script>

    <script src="{{ asset('../nabila/assets/plugins/d3/d3.min.js') }}"></script>

    <script src="{{ asset('../nabila/assets/plugins/c3-master/c3.min.js') }}"></script>

    <script src="{{ asset('../nabila/lite/js/dashboard.js') }}"></script>

    <script src="{{ asset('../js/app.js') }}"></script>
    <script src="{{ asset('../js/dynamic-form.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('../DataTables/datatables.min.css') }}"/>
    <script type="text/javascript" src="{{ asset('../DataTables/datatables.min.js') }}"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

</body>
    
    <script type="text/javascript">

         


        

        $(document).ready(function() {
            var dynamic_form =  $("#dynamic_form").dynamicForm("#dynamic_form","#plus5", "#minus5", {
                limit:100,
                formPrefix : "dynamic_form",
                normalizeFullForm : false
            });


            $("#dynamic_form #minus5").on('click', function(){

                 

                var initDynamicId = $(this).closest('#dynamic_form').parent().find("[id^='dynamic_form']").length;
                if (initDynamicId === 2) {
                    $(this).closest('#dynamic_form').next().find('#minus5').hide();
                }
                $(this).closest('#dynamic_form').remove();
                
        $('#total').val(total)
            });

            $('form').on('submit', function(event){
                var values = {};
                $.each($('form').serializeArray(), function(i, field) {
                    values[field.name] = field.value;
                });
                console.log(values)
            })

        });

        /*achat prestation*/


        
    
    $(document).ready(function() {
            var dynamic_form2 =  $("#dynamic_form4").dynamicForm("#dynamic_form4","#plus44", "#minus44", {
                limit:100,
                formPrefix : "dynamic_form4",
                normalizeFullForm : false
            });

            dynamic_form4.inject([{p_name: 'Hemant',quantity: '123',remarks: 'testing remark'},{p_name: 'Harshal',quantity: '123',remarks: 'testing remark'}]);

            $("#dynamic_form4 #minus44").on('click', function(){
                var initDynamicId = $(this).closest('#dynamic_form4').parent().find("[id^='dynamic_form4']").length;
                if (initDynamicId === 2) {
                    $(this).closest('#dynamic_form4').next().find('#minus44').hide();
                }
                $(this).closest('#dynamic_form4').remove();
            });

            $('form').on('submit', function(event){
                var values = {};
                $.each($('form').serializeArray(), function(i, field) {
                    values[field.name] = field.value;
                });
                console.log(values)
            })
        });


        $(document).ready(function() {
            var dynamic_form2 =  $("#dynamic_form2").dynamicForm("#dynamic_form2","#plus55", "#minus55", {
                limit:100,
                formPrefix : "dynamic_form2",
                normalizeFullForm : false
            });

            dynamic_form2.inject([{p_name: 'Hemant',quantity: '123',remarks: 'testing remark'},{p_name: 'Harshal',quantity: '123',remarks: 'testing remark'}]);

            $("#dynamic_form2 #minus55").on('click', function(){
                var initDynamicId = $(this).closest('#dynamic_form2').parent().find("[id^='dynamic_form2']").length;
                if (initDynamicId === 2) {
                    $(this).closest('#dynamic_form2').next().find('#minus55').hide();
                }
                $(this).closest('#dynamic_form2').remove();
            });

            $('form').on('submit', function(event){
                var values = {};
                $.each($('form').serializeArray(), function(i, field) {
                    values[field.name] = field.value;
                });
                console.log(values)
            })
        });

        $(document).ready(function() {
            var dynamic_form3 =  $("#dynamic_form3").dynamicForm("#dynamic_form3","#plus555", "#minus555", {
                limit:100,
                formPrefix : "dynamic_form3",
                normalizeFullForm : false
            });

            dynamic_form3.inject([{p_name: 'Hemant',quantity: '123',remarks: 'testing remark'},{p_name: 'Harshal',quantity: '123',remarks: 'testing remark'}]);

            $("#dynamic_form3 #minus55").on('click', function(){
                var initDynamicId = $(this).closest('#dynamic_form3').parent().find("[id^='dynamic_form3']").length;
                if (initDynamicId === 2) {
                    $(this).closest('#dynamic_form3').next().find('#minus55').hide();
                }
                $(this).closest('#dynamic_form3').remove();
            });

            $('form').on('submit', function(event){
                var values = {};
                $.each($('form').serializeArray(), function(i, field) {
                    values[field.name] = field.value;
                });
                console.log(values)
            })
        });



        /*Omar select multiple*/
        $(document).ready(function() {
    $('.js-example-basic-multiple').select2(
        {
            width:"100%"
        });
        });

        $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
        $(".acacher").hide(0);

        var i=0;

        function fshow (event) 
        {
            
            if (i%2==0)
            {
                event.preventDefault();

                $(".acacher").show(1000);

                $(".mdi-arrow-down-drop-circle-outline").attr('class','mdi mdi-arrow-up-drop-circle-outline');
            }
            else
            {
                
                event.preventDefault();

                $(".acacher").hide(1000);

                $(".mdi-arrow-up-drop-circle-outline").attr('class','mdi mdi-arrow-down-drop-circle-outline');                
                /**/                
            }

            i=i+1;

            // body... 
        }

                            /*************Produit**************/

        $(".acacher2").hide(0);

        var j=0;

        function fshow2 (event) 
        {
            
            if (j%2==0)
            {
                event.preventDefault();

                $(".acacher2").show(1000);

                $(".mdi-arrow-down-drop-circle-outline").attr('class','mdi mdi-arrow-up-drop-circle-outline');
            }
            else
            {
                
                event.preventDefault();

                $(".acacher2").hide(1000);

                $(".mdi-arrow-up-drop-circle-outline").attr('class','mdi mdi-arrow-down-drop-circle-outline');                
                /**/                
            }

            j=j+1;

            // body... 
        }

         $(".Parametre").hide(0);

        var j=0;

        function Parametre (event) 
        {
            
            if (j%2==0)
            {
                event.preventDefault();

                $(".Parametre").show(1000);

                $(".mdi-arrow-down-drop-circle-outline").attr('class','mdi mdi-arrow-up-drop-circle-outline');
            }
            else
            {
                
                event.preventDefault();

                $(".Parametre").hide(1000);

                $(".mdi-arrow-up-drop-circle-outline").attr('class','mdi mdi-arrow-down-drop-circle-outline');                
                /**/                
            }

            j=j+1;

            // body... 
        }


        $(".acacher3").hide(0);

        var j=0;

        function fshow3 (event) 
        {
            
            if (j%2==0)
            {
                event.preventDefault();

                $(".acacher3").show(1000);

                $(".mdi-arrow-down-drop-circle-outline").attr('class','mdi mdi-arrow-up-drop-circle-outline');
            }
            else
            {
                
                event.preventDefault();

                $(".acacher3").hide(1000);

                $(".mdi-arrow-up-drop-circle-outline").attr('class','mdi mdi-arrow-down-drop-circle-outline');                
                /**/                
            }

            j=j+1;

            // body... 
        }
    $(".acacherProduit").hide(0);

        var j=0;

        function fshowProduit (event) 
        {
            
            if (j%2==0)
            {
                event.preventDefault();

                $(".acacherProduit").show(1000);

                $(".mdi-arrow-down-drop-circle-outline").attr('class','mdi mdi-arrow-up-drop-circle-outline');
            }
            else
            {
                
                event.preventDefault();

                $(".acacherProduit").hide(1000);

                $(".mdi-arrow-up-drop-circle-outline").attr('class','mdi mdi-arrow-down-drop-circle-outline');                
                /**/                
            }

            j=j+1;

            // body... 
        }
            //Achat
         $(".DemandeAchat").hide(0);

        var i=0;

        function DemandeAchat (event) 
        {
            
            if (i%2==0)
            {
                event.preventDefault();

                $(".DemandeAchat").show(1000);

                $(".mdi-arrow-down-drop-circle-outline").attr('class','mdi mdi-arrow-up-drop-circle-outline');
            }
            else
            {
                
                event.preventDefault();

                $(".DemandeAchat").hide(1000);

                $(".mdi-arrow-up-drop-circle-outline").attr('class','mdi mdi-arrow-down-drop-circle-outline');                
                /**/                
            }

            i=i+1;

            // body... 
        }


         $(".DemandeVente").hide(0);

        var i=0;

        function DemandeVente (event) 
        {
            
            if (i%2==0)
            {
                event.preventDefault();

                $(".DemandeVente").show(1000);

                $(".mdi-arrow-down-drop-circle-outline").attr('class','mdi mdi-arrow-up-drop-circle-outline');
            }
            else
            {
                
                event.preventDefault();

                $(".DemandeVente").hide(1000);

                $(".mdi-arrow-up-drop-circle-outline").attr('class','mdi mdi-arrow-down-drop-circle-outline');                
                /**/                
            }

            i=i+1;

            // body... 
        }

        {{--  --}}
    </script>

    <script type="text/javascript">

        $(document).ready( function () 
        {
            $('#table_id').DataTable();
        });

        //
    </script>

     <script>
            
       function yesnoCheck() {
            if (document.getElementById('yesCheck').checked) {
                document.getElementById('myDIV').style.display = 'block';
            } 
            else if(document.getElementById('noCheck').checked) {
                document.getElementById('myDIV').style.display = 'none';
           }
        }

        //
    </script>

   

     <script>
            
       function yesnoCheckAnonyme() {
            if (document.getElementById('Fournisseur').checked) {
                document.getElementById('fournisseurdeclare').style.display = 'block';
             
            } 
            else if(document.getElementById('Anonyme').checked) {
                document.getElementById('fournisseurdeclare').style.display = 'none';
           }
        }

        //
    </script>

     <script>
            document.getElementById('Monjoint').style.display = 'block';
       function yesnoCheckJoint() {
            if (document.getElementById('Joint').checked) {
                document.getElementById('Monjoint').style.display = 'block';
            } 
            else if(document.getElementById('NonJoint').checked) {
                document.getElementById('Monjoint').style.display = 'none';
           }
        }

        //
    </script>

     <script>
            
       function yesnoCheckProduit() 
       {
            if (document.getElementById('YesProduit').checked) {
                document.getElementById('dynamic_form').style.display = 'block';
            } 
            else if(document.getElementById('NoProduit').checked) {
                document.getElementById('dynamic_form').style.display = 'none';
           }
        }

        //
    </script>

    

     
     <script>
            
       function FicheTechnique() 
       {
            if (document.getElementById('YesFiche').checked) {
                document.getElementById('dynamic_form').style.display = 'block';
            } 
            else if(document.getElementById('NoFiche').checked) {
                document.getElementById('dynamic_form').style.display = 'none';
           }
        }

        //
    </script>

    <script>
            
       function PhotoProduit() 
       {
            if (document.getElementById('YesPhoto').checked) {
                document.getElementById('MaPhoto').style.display = 'block';
            } 
            else if(document.getElementById('NoPhoto').checked) {
                document.getElementById('MaPhoto').style.display = 'none';
           }
        }

        //
    </script>

     <script>
            
       function FichePiece() 
       {
            if (document.getElementById('YesPiece').checked) {
                document.getElementById('MaPiece').style.display = 'block';
            } 
            else if(document.getElementById('NoPiece').checked) {
                document.getElementById('MaPiece').style.display = 'none';
           }
        }

        //
    </script>

    


    <script>

        var url1 = (window.location.href.substr(21));            
        
        function eventFire(el, etype){

            if (el.fireEvent) 
            {
                el.fireEvent('on' + etype);
            } 

            else 
            {
                var evObj = document.createEvent('Events');
                evObj.initEvent(etype, true, false);
                el.dispatchEvent(evObj);
            }

            //
        }        


        function indexes_of(str,char) 
        {
            
            var indices = [];
            
            for(var i=0; i<str.length;i++) 
            
            {
                if (str[i] === char) indices.push(i);
            }        

            return indices;

            //
        }

        var indexes = (indexes_of(url1,"/"))

        var le_href = (url1.substr(indexes[1]+1,indexes[2]-indexes[1]-1));
    
        le_href = le_href.toString();


        eventFire(document.getElementById(le_href),'click');

        {{--  --}}
    </script>

    <script type="text/javascript">
        
        window.onload = maxWindow;

        function maxWindow() 
        {
            window.moveTo(0, 0);

            if (document.all) 
            {
                top.window.resizeTo(screen.availWidth, screen.availHeight);
            }

            else if (document.layers || document.getElementById) 
            {
                if (top.window.outerHeight < screen.availHeight || top.window.outerWidth < screen.availWidth) 
                {
                    top.window.outerHeight = screen.availHeight;
                    top.window.outerWidth = screen.availWidth;
                }
            }
        }
    </script> 

    @if( $nbNonValide  != 0 )
    <script type="text/javascript">
        var blink_speed = 700; 
        var t = setInterval(function () 
            { var ele = document.getElementById('achats'); 
            ele.style.visibility = (ele.style.visibility == 'hidden' ? '' : 'hidden'); }, blink_speed);
    </script>
    @endif

    @yield('scripts')




    {{--  --}}
</html>