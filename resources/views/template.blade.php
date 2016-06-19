<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Priape</title>
    <link href="assets/css/popup.css" rel="stylesheet">
    <script src="assets/js/myjs.js"></script>
    @yield('css')




</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{route('dashboard')}}" class="site_title" ><img src="assets/images/logo.png" height="50" width="125" alt="..."/></a>
                </div>

                <!-- Mobile-->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    </div>
                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                        <img height="55" width="55" src="<?php if(Session::get('user')->getPicture() != null){
                            echo Session::get('user')->getPicture();
                        }else{
                            echo 'assets/images/user.png';
                        } ?>" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Bienvenue,</span>
                        <h2>{{Session::get('user')->getName()}}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <div class="clearfix"></div>
                        <ul style="margin-top: 1cm" class="nav side-menu">
                            <li><a href="{{route('dashboard')}}"><i class="fa fa-eye" aria-hidden="true"></i> Acceuil <span class="fa fa-chevron-right"></span></a>

                            </li>
                            <li><a href="{{route('profil')}}"><i class="fa fa-edit"></i> Profil <span class="fa fa-chevron-right"></span></a>

                            </li>
                            <li><a href="{{route('calendar')}}"><i class="fa fa-table"></i> Calendrier <span class="fa fa-chevron-right"></span></a>
                            </li>
                            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Deconnexion <span class="fa fa-chevron-right"></span></a>
                            </li>

                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->
                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings" onclick="div_show()">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </a>
                        <a>
                        <span class="glyphicon"></span>
                    </a>
                    <a>
                        <span class="glyphicon" ></span>
                    </a>
                    <a>
                        <span class="glyphicon"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>
        <div id="abc">
            <!-- Popup Div Starts Here -->
            <div id="popupContact" style="width: 15cm">
                <!-- Contact Us Form -->
                <form id="form" method="get" name="form" action="{{ route('deleteUser') }}">
                    <img id="close" src="assets/images/close.png" onclick ="div_hide()" height="50" width="50">
                    <h2 style="margin-left: 0.5cm; margin-top: 0.5cm">Etes-vous sur de vouloir supprimer votre compte ?</h2>
                    <hr style="margin-left: 0.5cm; margin-right: 0.5cm" >
                    <p style="margin: 0.3cm;">Toutes vos informations seront supprim&eacute;es et vous n&rsquo;aurez plus aucun acc&egrave;s &agrave; votre compte.</p>
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <input style="margin-top: 0.5cm" type="submit" name="submit" id="submit" value="Valider" class="btn btn-dark btn-lg pull-left">
                </form>
            </div>
            <!-- Popup Div Ends Here -->
        </div>

@yield('contenu')



</body>
</html>
<!-- footer content -->
<footer>
    <div class="pull-right">
       WebMaster & Designer :<a href="https://www.facebook.com/francois.colson">COLSON Francois</a>
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

@yield('js')


