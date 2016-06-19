@extends('../template')
@section('css')
        <!-- Bootstrap core CSS -->
<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="assets/css/custom.css" rel="stylesheet">
<!-- bootstrap-progressbar -->
<link href="assets/bootstrap//css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
<!-- jVectorMap -->
<link href="assets/css/maps/jquery-jvectormap-2.0.3.css" rel="stylesheet"/>

<link href="assets/css/toastr.css" rel="stylesheet"/>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<link href="assets/css/popup.css" rel="stylesheet">
<script src="assets/js/myjs.js"></script>
@endsection
@section('contenu')
    @if(Session::has('message'))

        <script src="assets/js/jquery.min.js"></script>
        <link href="assets/css/toastr.css" rel="stylesheet"/>
        <script src="assets/js/toastr.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                toastr.options.timeOut = 10000;
                @if(Session::has('message')["error"] == true)
                toastr.error({{Session::get('message')["message"]}});
                @else
                toastr.success('Votre travail &agrave; correctement &eacute;t&eacute; propos&eacute;');
                @endif
                $('#linkButton').click(function() {
                    toastr.success('Click Button');
                });
            });
        </script>
        {{ Session::forget('message')}}
    @endif

    <div id="abc">
        <!-- Popup Div Starts Here -->
        <div id="popupContact" style="width: 15cm">
            <!-- Contact Us Form -->
            <form id="form" method="post" name="form" action="{{ route('propose') }}">
                <img id="close" src="assets/images/close.png" onclick ="div_hide()" height="50" width="50">
                <h2 style="margin-left: 0.5cm; margin-top: 0.5cm">Demande d'ajout d'un travail</h2>
                <hr style="margin-left: 0.5cm; margin-right: 0.5cm" >
                <input id="work" name="work" placeholder="Travail &acirc; proposer" type="text" style="margin: 0.3cm">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input style="margin-top: 0.5cm" type="submit" name="submit" id="submit" value="Proposer" class="btn btn-dark btn-lg pull-left">
            </form>
        </div>
        <!-- Popup Div Ends Here -->
    </div>

        <!-- page content -->
<div class="right_col" role="main" >
    <div id="tohide">

        <div class="clearfix"></div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Modification <small>votre profil</small></h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />



                <div class="col-md-8 center-margin">
                    <form class="form-horizontal form-label-left" method="post" action="{{ route('editing') }}" >
                        <div class="form-group">
                            <label>Nom de votre entreprise</label>
                            <input type="text" class="form-control" value="{{Session::get('user')->getName()}}" name="name">
                        </div>
                        <div class="form-group">
                            <label>Num&eacute;ro de t&eacute;l&eacute;phone</label>
                            <input type="number" class="form-control" value="{{Session::get('user')->getPhone()}}" name="phone">
                        </div>
                        <div>
                            <input style="margin-top: 0.3cm; margin-bottom: 0.3cm" type="file" placeholder="Choissisez une image de profil" name="fileToUpload" id="fileToUpload">
                        </div>
                        <div class="form-group">
                            <label>Description de votre entreprise</label>
                            <textarea name="description"  id="description" placeholder="Description de votre entreprise"
                                      class="form-control" rows="10" cols="45" name="description"
                                      >{{Session::get('user')->getDescription()}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Votre adresse</label>
                            <select class="form-control" id="exampleSelect1" name="country">
                                <option>Belgique</option>
                            </select>
                            <input style="margin-top: 0.3cm" type="text" class="form-control" value="{{$street}}" placeholder="Rue" name="street">
                            <input style="margin-top: 0.3cm" type="number" class="form-control" value="{{$number}}" placeholder="Boite" name="number">
                            <input style="margin-top: 0.3cm" type="text" class="form-control" value="{{$city}}" placeholder="Ville" name="city">
                        </div>
                        <div class="form-group">
                            <label>Travaux que vous r&eacute;alisez</label><br>
                            @foreach($works as $work)
                            <input type="checkbox" name="work[]" <?php if(array_key_exists('checked',$work)) if($work['checked']) echo "checked" ?> value="{{$work['objectId'] }}|{{$work['name'] }}" style="margin-right: 0.2cm">{{$work['name']}}<br>
                                @endforeach
                        </div>

                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <input style="margin-top: 0.5cm" type="submit" name="submit"  value="Modifier" class="btn btn-dark btn-lg pull-left">
                    </form>
                    <a onclick="div_show()">  <p style="margin-top: 0.5cm
                        ;" id="popup"><u>Proposer un nouveau travail</u></p></a>
                </div>


            </div>
        </div>
    </div>

</div>
<!-- /page content -->

</div>
</div>


@endsection