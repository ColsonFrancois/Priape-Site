<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentallela Alela! | </title>

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

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                        <img src="<?php if(Session::get('user')->getPicture() != null){
                            echo Session::get('user')->getPicture();
                        }else{
                            echo 'assets/images/user.png';
                        } ?>" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
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
                            <li><a><i class="fa fa-edit"></i> Profil <span class="fa fa-chevron-right"></span></a>

                            </li>
                            <li><a href="{{route('calendar')}}"><i class="fa fa-table"></i> Calendrier <span class="fa fa-chevron-right"></span></a>
                            </li>
                            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Deconnexion <span class="fa fa-chevron-right"></span></a>
                            </li>

                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->

            </div>
        </div>


@yield('contenu')



</body>
</html>
<!-- footer content -->
<footer>
    <div class="pull-right">
        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

@yield('js')


