<!DOCTYPE html>
<html lang="en" dir="">


<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Image Cropper | Gull Admin Template</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet"/>
    <link href="{{ asset('../new_layout/gull/dist-assets/css/themes/lite-purple.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('../new_layout/gull/dist-assets/css/plugins/perfect-scrollbar.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('../new_layout/gull/dist-assets/css/plugins/cropper.min.css') }}" />
</head>

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">
        <div class="main-header">
            <div class="logo">
                <img src="{{ asset('../new_layout/gull/dist-assets/images/logo.png') }}" alt="">
            </div>
            <div class="menu-toggle">
                <div></div>
                <div></div>
                <div></div>
            </div>

            <div style="margin: auto"></div>

            <div class="header-part-right">
                <!-- Full screen toggle -->
                <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>
            </div>
        </div>

        <div class="side-content-wrap">
            
            <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
                <ul class="navigation-left">
                    <li class="nav-item" data-item="Profile"><a class="nav-item-hold" href="#"><i class="nav-icon i-Bar-Chart"></i><span class="nav-text">Profile</span></a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="Stock"><a class="nav-item-hold" href="#"><i class="nav-icon i-Library"></i><span class="nav-text">Stock</span></a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="Produits"><a class="nav-item-hold" href="#"><i class="nav-icon i-Suitcase"></i><span class="nav-text">Produits</span></a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="Fournisseur"><a class="nav-item-hold" href="#"><i class="nav-icon i-Computer-Secure"></i><span class="nav-text">Fournisseur</span></a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="Achat"><a class="nav-item-hold" href="#"><i class="nav-icon i-Computer-Secure"></i><span class="nav-text">Achat</span></a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="Client"><a class="nav-item-hold" href="#"><i class="nav-icon i-File-Clipboard-File--Text"></i><span class="nav-text">Client</span></a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="Vente"><a class="nav-item-hold" href="#"><i class="nav-icon i-File-Clipboard-File--Text"></i><span class="nav-text">Vente</span></a>
                        <div class="triangle"></div>
                    </li>

                </ul>
            </div>
            
            <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar="" data-suppress-scroll-x="true">
                <!-- Submenu Dashboards-->
                <ul class="childNav" data-parent="Stock">
                    <li class="nav-item"><a href="form.basic.html"><i class="nav-icon i-File-Clipboard-Text--Image"></i><span class="item-name">Dépot</span></a></li>
                    <li class="nav-item"><a href="form.layouts.html"><i class="nav-icon i-Split-Vertical"></i><span class="item-name">Local</span></a></li>
                    <li class="nav-item"><a href="form.input.group.html"><i class="nav-icon i-Receipt-4"></i><span class="item-name">Rayon</span></a></li>
                    <li class="nav-item"><a href="form.input.group.html"><i class="nav-icon i-Receipt-4"></i><span class="item-name">Etagère</span></a></li>
                    <li class="nav-item"><a href="form.input.group.html"><i class="nav-icon i-Receipt-4"></i><span class="item-name">Produits</span></a></li>
                </ul>
                <ul class="childNav" data-parent="apps">
                    <li class="nav-item"><a href="invoice.html"><i class="nav-icon i-Add-File"></i><span class="item-name">Invoice</span></a></li>
                    <li class="nav-item"><a href="inbox.html"><i class="nav-icon i-Email"></i><span class="item-name">Inbox</span></a></li>
                    <li class="nav-item"><a href="chat.html"><i class="nav-icon i-Speach-Bubble-3"></i><span class="item-name">Chat</span></a></li>
                </ul>
                <ul class="childNav" data-parent="widgets">
                    <li class="nav-item"><a href="widget-card.html"><i class="nav-icon i-Receipt-4"></i><span class="item-name">widget card</span></a></li>
                    <li class="nav-item"><a href="widget-statistics.html"><i class="nav-icon i-Receipt-4"></i><span class="item-name">widget statistics</span></a></li>
                    <li class="nav-item"><a href="widget-list.html"><i class="nav-icon i-Receipt-4"></i><span class="item-name">Widget List <span class="ml-2 badge badge-pill badge-danger">New</span></span></a></li>
                </ul>
                <!-- chartjs-->
                <ul class="childNav" data-parent="charts">
                    <li class="nav-item"><a href="charts.echarts.html"><i class="nav-icon i-File-Clipboard-Text--Image"></i><span class="item-name">echarts</span></a></li>
                    <li class="nav-item"><a href="charts.chartsjs.html"><i class="nav-icon i-File-Clipboard-Text--Image"></i><span class="item-name">ChartJs</span></a></li>
                    <li class="nav-item dropdown-sidemenu"><a href="#"><i class="nav-icon i-File-Clipboard-Text--Image"></i><span class="item-name">Apex Charts</span><i class="dd-arrow i-Arrow-Down"></i></a>
                        <ul class="submenu">
                            <li><a href="charts.apexAreaCharts.html">Area Charts</a></li>
                            <li><a href="charts.apexBarCharts.html">Bar Charts</a></li>
                            <li><a href="charts.apexBubbleCharts.html">Bubble Charts</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="childNav" data-parent="extrakits">
                    <li class="nav-item"><a href="image.cropper.html"><i class="nav-icon i-Crop-2"></i><span class="item-name">Image Cropper</span></a></li>
                    <li class="nav-item"><a href="loaders.html"><i class="nav-icon i-Loading-3"></i><span class="item-name">Loaders</span></a></li>
                    <li class="nav-item"><a href="upload.html"><i class="nav-icon i-Data-Upload"></i><span class="item-name">Upload</span></a></li>
                </ul>
                <ul class="childNav" data-parent="uikits">
                    <li class="nav-item"><a href="alerts.html"><i class="nav-icon i-Bell1"></i><span class="item-name">Alerts</span></a></li>
                    <li class="nav-item"><a href="accordion.html"><i class="nav-icon i-Split-Horizontal-2-Window"></i><span class="item-name">Accordion</span></a></li>
                    <li class="nav-item"><a href="badges.html"><i class="nav-icon i-Medal-2"></i><span class="item-name">Badges</span></a></li>
                    <li class="nav-item"><a href="buttons.html"><i class="nav-icon i-Cursor-Click"></i><span class="item-name">Buttons</span></a></li>
                    <li class="nav-item"><a href="cards.html"><i class="nav-icon i-Line-Chart-2"></i><span class="item-name">Cards</span></a></li>
                    <li class="nav-item"><a href="card.metrics.html"><i class="nav-icon i-ID-Card"></i><span class="item-name">Card Metrics</span></a></li>
                    <li class="nav-item"><a href="carousel.html"><i class="nav-icon i-Video-Photographer"></i><span class="item-name">Carousels</span></a></li>
                    <li class="nav-item"><a href="lists.html"><i class="nav-icon i-Belt-3"></i><span class="item-name">Lists</span></a></li>
                </ul>
                <ul class="childNav" data-parent="sessions">
                    <li class="nav-item"><a href="http://demos.ui-lib.com/gull/html/sessions/signin.html"><i class="nav-icon i-Checked-User"></i><span class="item-name">Sign in</span></a></li>
                    <li class="nav-item"><a href="http://demos.ui-lib.com/gull/html/sessions/signup.html"><i class="nav-icon i-Add-User"></i><span class="item-name">Sign up</span></a></li>
                    <li class="nav-item"><a href="http://demos.ui-lib.com/gull/html/sessions/forgot.html"><i class="nav-icon i-Find-User"></i><span class="item-name">Forgot</span></a></li>
                </ul>
                <ul class="childNav" data-parent="others">
                    <li class="nav-item"><a href="http://demos.ui-lib.com/gull/html/sessions/not-found.html"><i class="nav-icon i-Error-404-Window"></i><span class="item-name">Not Found</span></a></li>
                    <li class="nav-item"><a href="user.profile.html"><i class="nav-icon i-Male"></i><span class="item-name">User Profile</span></a></li>
                    <li class="nav-item"><a class="open" href="blank.html"><i class="nav-icon i-File-Horizontal"></i><span class="item-name">Blank Page</span></a></li>
                </ul>
            </div>
            <div class="sidebar-overlay"></div>
        </div>
        <!-- =============== Left side End ================-->
        <div class="main-content-wrap sidenav-open d-flex flex-column">

            @yield('content')

            {{--  --}}
        </div>

    </div><!-- ============ Search UI Start ============= -->

    <!-- ============ Search UI End ============= -->
    <script src="{{ asset('../new_layout/gull/dist-assets/js/plugins/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('../new_layout/gull/dist-assets/js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('../new_layout/gull/dist-assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('../new_layout/gull/dist-assets/js/scripts/script.min.js') }}"></script>
    <script src="{{ asset('../new_layout/gull/dist-assets/js/scripts/sidebar.large.script.min.js') }}"></script>
    <script src="{{ asset('../new_layout/gull/dist-assets/js/plugins/cropper.min.js') }}"></script>
    <script src="{{ asset('../new_layout/gull/dist-assets/js/scripts/cropper.script.min.js') }}"></script>
</body>


<!-- Mirrored from demos.ui-lib.com/gull/html/layout1/image.cropper.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 06 Dec 2020 19:05:49 GMT -->
</html>