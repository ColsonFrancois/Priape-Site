@extends('../template')
@section('contenu')



    @if(Session::has('user'))
        @if(empty(Session::get('user')->works))
        <script src="assets/js/jquery-2.1.4.min.js"></script>
        <link href="assets/css/toastr.css" rel="stylesheet"/>
        <script src="assets/js/toastr.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                toastr.options.timeOut = 10000;
                toastr.warning('Votre entreprise n\'est pas visible. Rendez-vous dans votre profil pour modifier vos travaux');
                $('#linkButton').click(function() {
                    toastr.success('Click Button');
                });
            });
        </script>
        @endif
@endif

        <!-- WRAPPER -->
<div class="wrapper">
    <!-- HERO -->
    <section id="hero" class="module-hero bg-dark-30 js-fullheight" data-background="assets/images/background.jpg">
        <!-- HERO TEXT -->
        <div class="hero-caption">
            <div class="hero-text">
                <h6 class="m-b-30">Application mobile</h6>
                <h1 class="m-b-30">Cherchez-vous un professionnel?</h1>
                <h6 class="m-b-60">priape est fait pour vous</h6>
                <a href="#portfolio" class="btn btn-dark anim-scroll">En savoir plus</a>
            </div>
        </div>
        <!-- /HERO TEXT -->

    </section>
    <!-- /HERO -->

    <!-- SERVICES -->
    <section id="portfolio" class="module">
        <div class="container-fluid container-custom">

            <!-- MODULE TITLE -->
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h2 class="module-title font-alt">Nos services</h2>
                    <p class="module-subtitle">Priape est plus qu'une simple application.</p>
                </div>
            </div>
            <!-- /MODULE TITLE -->
{{--
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center m-b-60">
                        <img src="assets/images/notebooks.jpg" alt="">
                    </div>
                </div>
            </div>--}}

            <div class="row multi-columns-row">

                <!-- ICONBOX -->
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="iconbox">
                        <div class="iconbox-icon">
                            <span class="icon-mobile"></span>
                        </div>
                        <div class="iconbox-header">
                            <h4 class="iconbox-title font-alt">Application android</h4>
                        </div>
                        <div class="iconbox-content">
                            <p>Priape est une application a la pointe de la technologie, utilisant les dernires fonctionnalitees stylistique.</p>
                        </div>
                    </div>
                </div>
                <!-- /ICONBOX -->

                <!-- ICONBOX -->
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="iconbox">
                        <div class="iconbox-icon">
                            <span class="icon-linegraph"></span>
                        </div>
                        <div class="iconbox-header">
                            <h4 class="iconbox-title font-alt">Visibilite de votre entreprise</h4>
                        </div>
                        <div class="iconbox-content">
                            <p>Grace a priape, vous serez visibile au yeux des utilisateur. En un clique, ils pourront acceder a votre profil.</p>
                        </div>
                    </div>
                </div>
                <!-- /ICONBOX -->

                <!-- ICONBOX -->
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="iconbox">
                        <div class="iconbox-icon">
                            <span class="icon-strategy"></span>
                        </div>
                        <div class="iconbox-header">
                            <h4 class="iconbox-title font-alt">Gestion</h4>
                        </div>
                        <div class="iconbox-content">
                            <p>Grace a un control panel, contruisez-vous un planning et consultez les commentaires laissez pas les utilisateurs.</p>
                        </div>
                    </div>
                </div>
                <!-- /ICONBOX -->

{{--                <!-- ICONBOX -->
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <div class="iconbox">
                        <div class="iconbox-icon">
                            <span class="icon-layers"></span>
                        </div>
                        <div class="iconbox-header">
                            <h4 class="iconbox-title font-alt">Modular Layout</h4>
                        </div>
                        <div class="iconbox-content">
                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life.</p>
                        </div>
                    </div>
                </div>
                <!-- /ICONBOX -->--}}

            </div>

        </div>
    </section>
    <!-- /SERVICES -->
@endsection