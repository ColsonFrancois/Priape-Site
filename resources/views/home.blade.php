<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Priape </title>

    <!-- Bootstrap -->
    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="assets/css/custom.css" rel="stylesheet">
</head>


@if(isset($error))
    @if($error == 'null')
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


<body style="background:#F7F7F7;">
<div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">
        <div id="login" class=" form">
            <section class="login_content">
                <form role="form-group" method="post" action="{{ route('authentification') }}" >
                    <h1>Connexion</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="email" name="email" required />
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password" placeholder="mot de passe" required />
                    </div>
                    <div>
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <input type="submit" name="submit" id="submit" value="Connexion" class="btn btn-dark btn-lg pull-left">
                        <a class="reset_pass" href="#">mot de passe perdu?</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">

                        <p>Pas encore inscrit?
                            <a href="{{ route('register') }}"> Inscrivez-vous </a>
                        </p>
                        <div class="clearfix"></div>
                        <br />
                        <div>
                            <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Priape application Android!</h1>

                            <p>WebDesigner & WebMaster : <a href="https://www.facebook.com/francois.colson">Colson Francois</a></p>
                        </div>
                    </div>
                </form>
            </section>
        </div>


    </div>
</div>
</body>
</html>