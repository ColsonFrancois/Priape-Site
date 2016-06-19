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
<link href="assets/css/popup.css" rel="stylesheet">
<script src="assets/js/myjs.js"></script>
    @endsection
@section('contenu')

    <div id="abc">
        <!-- Popup Div Starts Here -->
        <div id="popupContact" style="width: 15cm">
            <!-- Contact Us Form -->
            <form id="form" method="post" name="form" action="{{ route('report') }}">
                <img id="close" src="assets/images/close.png" onclick ="div_hide()" height="50" width="50">
                <h2 style="margin-left: 0.5cm; margin-top: 0.5cm">Signaler ce commentaire</h2>
                <hr style="margin-left: 0.5cm; margin-right: 0.5cm" >
                <select class="form-control" id="work" name="report" style="margin: 0.3cm">
                    <option>Insultes</option>
                    <option>Ne correspond pas au travail fournit</option>
                    <option>Menaces</option>
                    <option>Autres</option>
                </select>
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input style="margin-top: 0.5cm" type="submit" name="submit" id="submit" value="Signaler" class="btn btn-dark btn-lg pull-left">
            </form>
        </div>
        <!-- Popup Div Ends Here -->
    </div>

    @if(count(Session::get('user')->getWorks()) <= 0)

            <script src="assets/js/jquery.min.js"></script>
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
        @if(Session::has('message'))
            <script src="assets/js/jquery.min.js"></script>
            <link href="assets/css/toastr.css" rel="stylesheet"/>
            <script src="assets/js/toastr.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    toastr.options.timeOut = 10000;
                    toastr.success('Votre requete a ete prise en compte');
                    $('#linkButton').click(function() {
                        toastr.success('Click Button');
                    });
                });
            </script>
            {{ Session::forget('message')}}
        @endif





        <!-- page content -->
<div class="right_col" role="main">
    <br />
    <div class="row">
    </div>


    <div class="row" id="tohide">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Dernier commentaires</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="dashboard-widget-content">

                        <ul class="list-unstyled timeline widget">
                            @foreach($comments as $comment)
                            <li>
                                <div class="block">
                                    <div class="block_content">
                                        <h2 class="title">
                                            Note : {{$comment['note']}} /10

                                        </h2>
                                        <div class="byline">
                                            <span>Post&eacute; le : {{date('d/m/y', substr($comment['created'],0, -3))}}</span> par {{$comment['name']}}
                                        </div>
                                      <h4>{{$comment['message']}}&nbsp;&nbsp;</h4> <p><a  onclick="div_show() <?php Session::put('comment', $comment['message']." posté par ".$comment['name']); ?>">Signaler</a>
                                        </p>
                                    </div>
                                </div>
                            </li>@endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="row">


                <!-- Start to do list -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>A faire <small>programme du jour</small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <div class="">
                                <ul class="to_do">
                                    @foreach($events as $event)
                                        @if(date('d/m/y', $event['scheduled']) == date('d/m/y'))
                                    <li>
                                       <?php $date = new DateTime("@". $event['scheduled']);
                                        $date->setTimezone(new DateTimeZone('Europe/Berlin'));
                                        echo $date->format('H:i') .'  '.$event['title']?>
                                    </li>
                                        @endif
                                        @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End to do list -->

                <!-- start of weather widget -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Meteo<small>temperature annonc&eacute;es</small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="temperature"><b><?php
                                            switch($weather[0]['day']){
                                                case 0:
                                                    echo "Dimanche";
                                                    break;
                                                case 1:
                                                    echo "Lundi";
                                                    break;
                                                case 2:
                                                    echo "Mardi";
                                                    break;
                                                case 3:
                                                    echo "Mercredi";
                                                    break;
                                                case 4:
                                                    echo "Jeudi";
                                                    break;
                                                case 5:
                                                    echo "Vendredi";
                                                    break;
                                                case 6:
                                                    echo "Samedi";
                                                    break;
                                            }

                                            ?>
                                        </b>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="weather-icon">
                                        <img height="84" width="84" src="<?php echo 'assets/images/meteo/'.$weather[0]['icon'].'.png' ?>" />
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="weather-text">
                                        <h2>{{$weather[0]['city']}}<br></h2>
                                        <span>Belgique</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="weather-text pull-right">
                                    <h1 class="degrees">{{$weather[0]['temp']}}</h1>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <div class="row weather-days">
                                @foreach($weather as $weath)
                                    @if($weather[0]['day'] == $weath['day'])

                                @else
                                <div class="col-sm-2">
                                    <div class="daily-weather">
                                        <h2 class="day"><?php
                                            switch($weath['day']){
                                                case 0:
                                                    echo "Dim";
                                                    break;
                                                case 1:
                                                    echo "Lun";
                                                    break;
                                                case 2:
                                                    echo "Mar";
                                                    break;
                                                case 3:
                                                    echo "Mer";
                                                    break;
                                                case 4:
                                                    echo "Jeu";
                                                    break;
                                                case 5:
                                                    echo "Ven";
                                                    break;
                                                case 6:
                                                    echo "Sam";
                                                    break;
                                            }

                                            ?></h2>
                                        <h3 class="degrees">{{$weath['temp']}}</h3>
                                        <img style="margin-left: 0.2cm" height="32" width="32" src="<?php echo 'assets/images/meteo/'.$weath['icon'].'.png' ?>"/>
                                    </div>
                                </div>
                                    @endif
                                @endforeach
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end of weather widget -->

                <div class="col-md-12 col-sm-6 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Statistiques<small>Travaux les plus r&eacute;alis&eacute;s</small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @foreach($percents as $percent)
                            <div class="widget_summary">
                                <div class="w_left w_25">
                                    <span>{{$percent['name']}}</span>
                                </div>
                                <div class="w_center w_55">
                                    <div class="progress">
                                        <div class="progress-bar bg-green" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percent['percent'].'%'; ?>;">
                                        </div>
                                    </div>
                                </div>
                                <div class="w_right w_20">
                                    <span>{{$percent['percent']}} %</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                                @endforeach



                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- /page content -->





    @endsection
@section('js')
            <!-- jQuery -->
            <script src="assets/js/jquery.min.js"></script>
            <!-- Bootstrap -->
            <script src="assets/js/bootstrap.min.js"></script>


            <!-- Custom Theme Scripts -->
            <script src="assets/js/custom.js"></script>



    @endsection