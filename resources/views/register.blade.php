@extends('../template')
@section('contenu')
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

            <form role="form" method="post" action="{{route('registration')}}" >
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" name="name" placeholder="Votre pseudo" value="{{ old('name') }}" required >
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
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}"> <!-- Token pour sécurisé l'envoie des information -->
                    <input type="submit" name="submit" id="submit" value="Inscription" class="btn btn-dark btn-lg pull-right">
                </div>
            </form>

        </div>
    </section>
@endsection