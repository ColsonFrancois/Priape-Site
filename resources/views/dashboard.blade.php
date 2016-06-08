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
    @endsection
@section('contenu')


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




        <!-- page content -->
<div class="right_col" role="main">




    <br />

    <div class="row">







    </div>


    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Dernier commentaires</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
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
                                            <span>Post&eacute;&eacute; le : {{date('d/m/y', substr($comment['created'],0, -3))}}</span> par {{$comment['name']}}
                                        </div>
                                        <p class="excerpt">{{$comment['message']}}&nbsp;&nbsp;<a>Signaler</a>
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
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <div class="">
                                <ul class="to_do">
                                    @foreach($events as $event)
                                        @if(date('d/m/y', $event['scheduled']) == date('d/m/y'))
                                    <li>
                                        <p> {{date('h:i', $event['scheduled'])}} {{$event['title']}} </p>
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
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
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
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
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
            <!-- FastClick -->
            <script src="assets/js/fastclick.js"></script>
            <!-- NProgress -->
            <script src="assets/js/nprogress.js"></script>
            <!-- Chart.js -->
            <script src="assets/js/Chart.min.js"></script>
            <!-- gauge.js -->
            <script src="assets/jst/gauge.min.js"></script>
            <!-- bootstrap-progressbar -->
            <script src="assets/js/bootstrap-progressbar.min.js"></script>

            <!-- Skycons -->
            <script src="../vendors/skycons/skycons.js"></script>
            <!-- Flot -->
            <script src="../vendors/Flot/jquery.flot.js"></script>
            <script src="../vendors/Flot/jquery.flot.pie.js"></script>
            <script src="../vendors/Flot/jquery.flot.time.js"></script>
            <script src="../vendors/Flot/jquery.flot.stack.js"></script>
            <script src="../vendors/Flot/jquery.flot.resize.js"></script>
            <!-- Flot plugins -->
            <script src="assets/js/flot/jquery.flot.orderBars.js"></script>
            <script src="assets/js/flot/date.js"></script>
            <script src="assets/js/flot/jquery.flot.spline.js"></script>
            <script src="assets/js/flot/curvedLines.js"></script>
            <!-- jVectorMap -->
            <script src="assets/js/maps/jquery-jvectormap-2.0.3.min.js"></script>
            <!-- bootstrap-daterangepicker -->
            <script src="assets/js/moment/moment.min.js"></script>
            <script src="assets/js/datepicker/daterangepicker.js"></script>
            <script src="assets/js/toastr.js"></script>



            <!-- Custom Theme Scripts -->
            <script src="assets/js/custom.js"></script>
            <!-- Flot -->
            <script>
                $(document).ready(function() {
                    var data1 = [
                        [gd(2012, 1, 1), 17],
                        [gd(2012, 1, 2), 74],
                        [gd(2012, 1, 3), 6],
                        [gd(2012, 1, 4), 39],
                        [gd(2012, 1, 5), 20],
                        [gd(2012, 1, 6), 85],
                        [gd(2012, 1, 7), 7]
                    ];

                    var data2 = [
                        [gd(2012, 1, 1), 82],
                        [gd(2012, 1, 2), 23],
                        [gd(2012, 1, 3), 66],
                        [gd(2012, 1, 4), 9],
                        [gd(2012, 1, 5), 119],
                        [gd(2012, 1, 6), 6],
                        [gd(2012, 1, 7), 9]
                    ];
                    $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
                        data1, data2
                    ], {
                        series: {
                            lines: {
                                show: false,
                                fill: true
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 0,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            verticalLines: true,
                            hoverable: true,
                            clickable: true,
                            tickColor: "#d5d5d5",
                            borderWidth: 1,
                            color: '#fff'
                        },
                        colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
                        xaxis: {
                            tickColor: "rgba(51, 51, 51, 0.06)",
                            mode: "time",
                            tickSize: [1, "day"],
                            //tickLength: 10,
                            axisLabel: "Date",
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: 'Verdana, Arial',
                            axisLabelPadding: 10
                        },
                        yaxis: {
                            ticks: 8,
                            tickColor: "rgba(51, 51, 51, 0.06)",
                        },
                        tooltip: false
                    });

                    function gd(year, month, day) {
                        return new Date(year, month - 1, day).getTime();
                    }
                });
            </script>
            <!-- /Flot -->

            <!-- jVectorMap -->
            <script src="assets/js/maps/jquery-jvectormap-world-mill-en.js"></script>
            <script src="assets/js/maps/jquery-jvectormap-us-aea-en.js"></script>
            <script src="assets/js/maps/gdp-data.js"></script>
            <script>
                $(document).ready(function(){
                    $('#world-map-gdp').vectorMap({
                        map: 'world_mill_en',
                        backgroundColor: 'transparent',
                        zoomOnScroll: false,
                        series: {
                            regions: [{
                                values: gdpData,
                                scale: ['#E6F2F0', '#149B7E'],
                                normalizeFunction: 'polynomial'
                            }]
                        },
                        onRegionTipShow: function(e, el, code) {
                            el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
                        }
                    });
                });
            </script>
            <!-- /jVectorMap -->

            <!-- Skycons -->
            <script>
                $(document).ready(function() {
                    var icons = new Skycons({
                                "color": "#73879C"
                            }),
                            list = [
                                "clear-day", "clear-night", "partly-cloudy-day",
                                "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                                "fog"
                            ],
                            i;

                    for (i = list.length; i--;)
                        icons.set(list[i], list[i]);

                    icons.play();
                });
            </script>
            <!-- /Skycons -->

            <!-- Doughnut Chart -->
            <script>
                $(document).ready(function(){
                    var options = {
                        legend: false,
                        responsive: false
                    };

                    new Chart(document.getElementById("canvas1"), {
                        type: 'doughnut',
                        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                        data: {
                            labels: [
                                "Symbian",
                                "Blackberry",
                                "Other",
                                "Android",
                                "IOS"
                            ],
                            datasets: [{
                                data: [15, 20, 30, 10, 30],
                                backgroundColor: [
                                    "#BDC3C7",
                                    "#9B59B6",
                                    "#E74C3C",
                                    "#26B99A",
                                    "#3498DB"
                                ],
                                hoverBackgroundColor: [
                                    "#CFD4D8",
                                    "#B370CF",
                                    "#E95E4F",
                                    "#36CAAB",
                                    "#49A9EA"
                                ]
                            }]
                        },
                        options: options
                    });
                });
            </script>
            <!-- /Doughnut Chart -->



            <!-- gauge.js -->
            <script>
                var opts = {
                    lines: 12,
                    angle: 0,
                    lineWidth: 0.4,
                    pointer: {
                        length: 0.75,
                        strokeWidth: 0.042,
                        color: '#1D212A'
                    },
                    limitMax: 'false',
                    colorStart: '#1ABC9C',
                    colorStop: '#1ABC9C',
                    strokeColor: '#F0F3F3',
                    generateGradient: true
                };
                var target = document.getElementById('foo'),
                        gauge = new Gauge(target).setOptions(opts);

                gauge.maxValue = 6000;
                gauge.animationSpeed = 32;
                gauge.set(3200);
                gauge.setTextField(document.getElementById("gauge-text"));
            </script>
            <!-- /gauge.js -->
    @endsection