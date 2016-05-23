
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Priape - Application mobile</title>

    <!-- Favicons -->
    <link rel="shortcut icon" href="assets/images/favicon.png">
    <link rel="apple-touch-icon" href="assets/images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/images/apple-touch-icon-114x114.png">

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700' rel='stylesheet' type='text/css'>

    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/toastr.css" rel="stylesheet"/>

    <!-- Icon Fonts -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/et-line-font.min.css" rel="stylesheet">

    <!-- Plugins -->
    <link href="assets/css/magnific-popup.css" rel="stylesheet">
    <link href="assets/css/superslides.css" rel="stylesheet">
    <link href="assets/css/vertical.min.css" rel="stylesheet">

    <!-- Template core CSS -->
    <link href="assets/css/template.css" rel="stylesheet">
    <link href="assets/css/calendrier.css" rel="stylesheet">



</head>
<body>


@if(Session::has('ok'))

    <h2>{{ Session::get('ok') }}</h2>
    @endif
<!-- PRELOADER -->
<div class="page-loader">
    <div class="loader">Loading...</div>
</div>
<!-- /PRELOADER -->

<!-- SIDEBAR -->
<div class="sidebar">

    <nav class="navbar navbar-custom font-alt">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#custom-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- YOU LOGO HERE -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <!-- IMAGE OR SIMPLE TEXT -->
                <img class="light-logo" src="assets/images/logo.png" width="115" alt="">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="custom-collapse">

            <ul class="nav navbar-nav">

                <li><a href="{{ route('home') }}">Acceuil</a></li>

                @if(Session::has('user'))
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">@if(strlen(Session::get('user')->getName())> 20)
                                {{substr(Session::get('user')->getName(),0,-(strlen(Session::get('user')->getName())-20))."..."}}
                             @else
                                {{ Session::get('user')->getName() }}
                            @endif</a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('dashboard') }}">Controle panel</a></li>
                            <li><a href="{{ route('profil') }}">Mon profil</a></li>
                            <li><a href="{{ route('calendar') }}">Calendrier</a></li>
                            <li><a  href="{{ route('logout') }}">Deconnexion</a></li>
                        </ul>
                    </li>
                @else
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">Espace professionnel</a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('login') }}">Connexion</a></li>
                            <li><a href="{{ route('register') }}">Inscription</a></li>
                        </ul>
                    </li>
                    @endif

                <li  class="anim-scroll">
                    <a href="#portfolio">Qu'est ce que Priape ?</a>
                </li>

                <li><a href="#">Telechargement</a></li>

                <li><a href="{{'contact'}}">Contact</a></li>

            </ul>
        </div>

    </nav>

    <!-- SOCIAL LINKS -->
    <div class="copyright">
        <div class="social-icons m-b-20">
            <a href="#" target="_blank" class="fa fa-facebook facebook"></a>
            <a href="#" target="_blank" class="fa fa-twitter twitter"></a>
        </div>
    </div>
    <!-- /SOCIAL LINKS -->

</div>
<!-- /SIDEBAR -->

    <body>@yield('contenu')</body>

    <hr class="divider">



    <!-- FOOTER -->

    <footer class="footer module-overlay-dark-3">
        <div class="container-fluid container-custom">

            <div class="row">
                <div class="col-sm-12">
                    <div class="copyright text-center font-alt">
                        WebMaster & WebDesigner : <a href="https://www.facebook.com/francois.colson"> Fran&ccedil;ois Colson</a>.
                    </div>
                </div>
            </div>

            <!-- SCROLLTOP -->
            <a class="to-top-link" href="#top">
                <i class="fa fa-angle-up"></i>
            </a>

        </div>
    </footer>

    <!-- /FOOTER -->


</div>
<!-- /WRAPPER -->

<!-- JAVASCRIPT FILES -->
<script src="assets/js/jquery-2.1.4.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.superslides.min.js"></script>
<script src="assets/js/jquery.mb.YTPlayer.min.js"></script>
<script src="assets/js/imagesloaded.pkgd.js"></script>
<script src="assets/js/isotope.pkgd.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/jquery.fitvids.js"></script>
<script src="assets/js/jqBootstrapValidation.js"></script>
<script src="assets/js/gmap3.min.js"></script>
<script src="assets/js/appear.js"></script>
<script src="assets/js/smoothscroll.js"></script>
<script src="assets/js/submenu-fix.js"></script>
<script src="assets/js/custom.js"></script>
    <script src="assets/js/toastr.js"></script>



</body>

<!-- Mirrored from templates.mycookroom.ru/Stone-v1.0.1/Site/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 08 May 2016 13:09:38 GMT -->
</html>