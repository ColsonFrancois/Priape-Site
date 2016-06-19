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
    <style>

    </style>
</head>

<body style="background:#F7F7F7;">


@if(Session::has('message'))

    <script src="assets/js/jquery.min.js"></script>
    <link href="assets/css/toastr.css" rel="stylesheet"/>
    <script src="assets/js/toastr.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            toastr.options.timeOut = 10000;
            toastr.error('Votre adresse est invalide');
            $('#linkButton').click(function() {
                toastr.success('Click Button');
            });
        });
    </script>
    {{ Session::forget('message')}}
@endif

<div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">
        <div  class=" form">
            <section class="login_content">
                <form role="form-group" method="post" action="{{ route('registration') }}" >
                    <h1>Inscrivez-vous</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="nom de l'entreprise" name="name" required />
                    </div>
                    <div>
                        <input type="text" class="form-control" name="email" placeholder="Votre Email" required>
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password"  placeholder="Votre mot de passe" required>
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password_confirmation"  placeholder="Retapez votre mot de passe" required>
                    </div>
                    <div>
                        <input type="number" class="form-control" name="phone"  placeholder="Numero de telephone" required>
                    </div>
                    <div>
                        <input style="margin-top: 0.3cm" type="file" placeholder="Choissisez une image de profil" name="fileToUpload" id="fileToUpload">
                    </div>
                    <h5 class="pull-left">Votre emploie : </h5>
                    <div>
                        <div class="form-group">
                            <select class="form-control" id="exampleSelect1" name="job">
                                <option>Macon</option>
                                <option>Jardinier</option>
                                <option>plafonneur</option>
                                <option>Electricien</option>
                                <option>Menuisier</option>
                                <option>Carreleur</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="input-group">
                                    <textarea name="description"  id="description" placeholder="Description de votre entreprise"
                                              class="form-control" rows="10" cols="45"
                                              required></textarea>

                        </div>
                    </div>
                    <h5 class="pull-left">Adresse de votre entreprise : </h5>
                    <div>
                        <div class="form-group">
                            <select class="form-control" id="exampleSelect1" name="country">
                                <option>Belgique</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <input type="text" class="form-control" name="street" placeholder="Rue (Exemple : Rue de la place)" required >
                    </div>
                    <div style="margin-top: -0.2cm;">
                        <input type="number" class="form-control" name="number" placeholder="Numero (Exemple: 44)" required >
                    </div>
                    <div style="margin-top: 0.3cm;">
                        <input type="text" class="form-control" name="zip" placeholder="Votre ville (Exemple : Manage)" required >
                    </div>

                    <div>
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <input type="submit" name="submit" id="submit" value="inscription" class="btn btn-dark btn-lg pull-right">
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">

                        <p>deja membre?
                            <a href="{{ route('home') }}"> Connectez-vous  </a>
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