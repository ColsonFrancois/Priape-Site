@extends('../template')
@section('contenu')

    <section class="module">
        <div class="container-fluid container-custom">

            <!-- MODULE TITLE -->
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h2 class="module-title font-alt">Votre profil</h2>
                    <p class="module-subtitle">Vous pouvez modifier les informations concernant votre profil.</p>
                </div>
            </div>
            <!-- /MODULE TITLE -->

            <div class="container">
                <div class="row">

                    <form role="form" method="post" action="{{route('registration')}}" >
                        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                            <h6 for="InputMessage">Information sur l'entreprise</h6>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name" placeholder="Nom de l'entreprise" value="{{ Session::get('user')->name }}" required >
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <input type="number" class="form-control" name="phone" value="{{Session::get('user')->phone}}" placeholder="Numero de telephone" required>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <select class="form-control" id="exampleSelect1" name="job">
                                        <option <?php if(Session::get('user')->job == "Macon")  echo "selected='selected'";?>>Macon</option>
                                        <option <?php if(Session::get('user')->job == "Jardinier")  echo "selected='selected'";?>>Jardinier</option>
                                        <option <?php if(Session::get('user')->job == "Plafonneur")  echo "selected='selected'";?>>Plafonneur</option>
                                        <option <?php if(Session::get('user')->job == "Electricien")  echo "selected='selected'";?>>Electricien</option>
                                        <option <?php if(Session::get('user')->job == "Menuisier")  echo "selected='selected'";?>>Menuisier</option>
                                        <option <?php if(Session::get('user')->job == "Carreleur")  echo "selected='selected'";?>>Carreleur</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <textarea name="description" id="description" placeholder="Description de votre entreprise"
                                              class="form-control" rows="10"
                                              required>{{Session::get('user')->description}}</textarea>
                                    <span class="input-group-addon"><span
                                                class="glyphicon glyphicon-asterisk"></span></span>
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
                                    <input type="text" class="form-control" value="{{$street}}" name="street" placeholder="Rue (Exemple : Rue de la place)"  required >
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control"  value="{{$number}}" name="number" placeholder="Numero (Exemple: 44)" required >
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{$zip}}" name="zip" placeholder="Code postal (Exemple : 7170)" required >
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="checkbox">
                                        <label><input type="checkbox" value="">Option 1</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}"> <!-- Token pour sécurisé l'envoie des information -->
                            <input type="submit" name="submit" id="submit" value="Modifier" class="btn btn-dark btn-lg pull-right">
                        </div>


                    </form>


            </div>

        </div>
    </section>
    <!-- /CONTACT -->



    @endsection