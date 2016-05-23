@extends('../template')
@section('contenu')


    @if( !empty($error))

        @endif


    <section class="module-sm">
        <div class="container-fluid container-custom">

            <!-- MODULE TITLE -->
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h2 class="module-title font-alt m-b-0">Inscription</h2>
                </div>
            </div>
            <!-- /MODULE TITLE -->

        </div>
    </section>

    <hr class="divider">
    <section class="module">
        <div class="container">

            <form role="form" method="post" action="{{route('registration')}}" enctype="multipart/form-data" >
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <h6 for="InputMessage">Information sur l'entreprise</h6>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" name="name" placeholder="Nom de l'entreprise" value="{{ old('name') }}" required >
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" name="email" placeholder="Votre Email" value="{{ old('email') }}" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" class="form-control" name="password"  placeholder="Votre mot de passe" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" class="form-control" name="password_confirmation"  placeholder="Retapez votre mot de passe" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="number" class="form-control" name="phone"  placeholder="Numero de telephone" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    <div class="form-group">
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
                    <div class="form-group">
                        <div class="input-group">
                                    <textarea name="description"  id="description" placeholder="Description de votre entreprise"
                                              class="form-control" rows="10"
                                              required></textarea>
                                    <span class="input-group-addon"><span
                                                class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="file" name="image" id="image" placeholder="choissisez une photo">
                        </div>
                    </div>
                    <div class="form-group">
                        <h6 for="InputMessage">Adresse de votre entreprise</h6>
                        <div class="form-group">
                            <select class="form-control" id="exampleSelect1" name="country">
                                <option>Belgique</option>
                            </select>
                            </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" name="street" placeholder="Rue (Exemple : Rue de la place)"  required >
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="number" class="form-control" name="number" placeholder="Numero (Exemple: 44)" required >
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" name="zip" placeholder="Code postal (Exemple : 7170)" required >
                            <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}"> <!-- Token pour sécurisé l'envoie des information -->
                    <input type="submit" name="submit" id="submit" value="Inscription" class="btn btn-dark btn-lg pull-right">
                </div>

            </form>

        </div>
    </section>
@endsection