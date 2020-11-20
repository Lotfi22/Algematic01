<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Tell the browser to be responsive to screen width -->

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">

    <!-- Favicon icon -->

    <link rel="icon" type="image/svg" sizes="16x16" href="{{ asset('../../img/logo.svg') }}">

    <title>Welcome Admin</title>

    <!-- Bootstrap Core CSS -->

    <link href="{{ asset('../../nabila/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- This page CSS -->

    <link href="{{ asset('../../nabila/assets/plugins/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">

    
    <link href="{{ asset('../../nabila/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">

    <!--c3 CSS -->

    <link href="{{ asset('../../nabila/assets/plugins/c3-master/c3.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->

    <link href="{{ asset('../../nabila/lite/css/style.css') }}" rel="stylesheet">

    <!-- Dashboard 1 Page CSS -->

    <link href="{{ asset('../../nabila/lite/css/pages/dashboard.css') }}" rel="stylesheet">

    <!-- You can change the theme colors from here -->

    <link href="{{ asset('../../nabila/lite/css/colors/default-dark.css') }}" id="theme" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

<![endif]-->

</head>



<body class="fix-header fix-sidebar card-no-border">

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

    <div id="main-wrapper">

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

                            <img src="../../nabila/assets/images/logo-icon.png" alt="homepage" class="dark-logo" />

                        </b>

                        <!--End Logo icon -->

                        <!-- Logo text -->

                        <span>

                            <img src="../../img/logo.svg" alt="homepage" class="dark-logo" width="50%" />

                        </span>

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
{{-- 
                        <li class="nav-item hidden-xs-down search-box"> <a class="nav-link hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>

                            <form class="app-search">

                                <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a>

                            </form>

                        </li> --}}

                        <!-- ============================================================== -->

                        <!-- Profile -->

                        <!-- ============================================================== -->

                        <li class="nav-item">

                            <a class="nav-link waves-effect waves-dark" onclick="event.preventDefault();

                                document.getElementById('logout-form').submit();" href="{{ url('/logout') }}"><img src="../../nabila/assets/images/1.jpg" alt="user" class="profile-pic" />

                            </a>



                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">

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

                        <li> <a class="waves-effect waves-dark" href="/home4" onclick="fshow(event)" aria-expanded="false"><i class="mdi mdi-arrow-down-drop-circle-outline"></i><span class="hide-menu">Stock</span></a></li>


                        <li class="acacher"> <a class="waves-effect waves-dark" href="/depot" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Dépot</span></a></li>

                        <li class="acacher"> <a class="waves-effect waves-dark" href="/local" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Local</span></a></li>

                        <li class="acacher"> <a class="waves-effect waves-dark" href="/rayon" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Rayon</span></a></li>

                        <li class="acacher"> <a class="waves-effect waves-dark" href="/etagere" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Etagère</span></a></li>

                                            <!-- Fabricant_Fournisseur -->

                        <li> <a class="waves-effect waves-dark" href="/home4" onclick="fshow2(event)" aria-expanded="false"><i class="mdi mdi-arrow-down-drop-circle-outline"></i><span class="hide-menu" style="font-size: 12px;">Fabricant_Fournisseur</span></a></li>


                        <li class="acacher2"> <a class="waves-effect waves-dark" href="/fabricant" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Fabricant</span></a></li>

                        <li class="acacher2"> <a class="waves-effect waves-dark" href="/fournisseur" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Fournisseur</span></a></li>

                        

                        <!--Fin-->

                         <!-- Produit-Categorie_Famille_SousFamille -->

                        <li> <a class="waves-effect waves-dark" href="/home4" onclick="fshowProduit(event)" aria-expanded="false"><i class="mdi mdi-arrow-down-drop-circle-outline"></i><span class="hide-menu">Produit</span></a></li>


                        <li class="acacherProduit"> <a class="waves-effect waves-dark" href="/categorie" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Catégorie_Prod</span></a></li>

                        <li class="acacherProduit"> <a class="waves-effect waves-dark" href="/familleProd" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Famille_Prod</span></a></li>

                        <li class="acacherProduit"> <a class="waves-effect waves-dark" href="/sousFamille" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Sous_Famille_Prod</span></a></li>

                        <li class="acacherProduit"> <a class="waves-effect waves-dark" href="/propriete" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Propriétes_Produits</span></a></li>

                        <li class="acacherProduit"> <a class="waves-effect waves-dark" href="/unite" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Unité de Mesure</span></a></li>

                        <li class="acacherProduit"> <a class="waves-effect waves-dark" href="/produit" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Mes Produits</span></a></li>

                        <li class="acacherProduit"> <a class="waves-effect waves-dark" href="/technique" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Spécificité Technique</span></a></li>

                        <!--Fin-->

                        <li> <a class="waves-effect waves-dark" href="/home4" onclick="fshow3(event)" aria-expanded="false"><i class="mdi mdi-arrow-down-drop-circle-outline"></i><span class="hide-menu">Client</span></a></li>


                        <li class="acacher3"> <a class="waves-effect waves-dark" href="/home/clients/categorie" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Catégorie</span></a></li>

                        <li class="acacher3"> <a class="waves-effect waves-dark" href="/home/clients/activite" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Activité</span></a></li>

                        <li class="acacher3"> <a class="waves-effect waves-dark" href="/home/clients" aria-expanded="false"><i class="mdi mdi-dots-vertical "></i><span class="hide-menu">Clients | Prospect</span></a></li>



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


        <div class="page-wrapper">

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

    <script src="{{ asset('../../nabila/assets/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('../../nabila/assets/plugins/bootstrap/js/popper.min.js') }}"></script>

    <script src="{{ asset('../../nabila/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('../../nabila/lite/js/perfect-scrollbar.jquery.min.js') }}"></script>

    <script src="{{ asset('../../nabila/lite/js/waves.js') }}"></script>

    <script src="{{ asset('../../nabila/lite/js/sidebarmenu.js') }}"></script>

    <script src="{{ asset('../../nabila/lite/js/custom.min.js') }}"></script>

    <script src="{{ asset('../../nabila/assets/plugins/chartist-js/dist/chartist.min.js') }}"></script>

    <script src="{{ asset('../../nabila/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script>

    <script src="{{ asset('../../nabila/assets/plugins/d3/d3.min.js') }}"></script>

    <script src="{{ asset('../../nabila/assets/plugins/c3-master/c3.min.js') }}"></script>

    <script src="{{ asset('../../nabila/lite/js/dashboard.js') }}"></script>

    <script src="{{ asset('../../js/jquery-3.2.1.min.js') }}"></script>

    <script src="{{ asset('../../js/app.js') }}"></script>

</body>
    
    <script type="text/javascript">
        
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
        
        {{--  --}}
    </script>
    

</html>