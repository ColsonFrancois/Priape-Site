@extends('../template')
@section('css')

    <link href="https://colorlib.com/polygon/gentelella/css/bootstrap.min.css" rel="stylesheet">

    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="https://colorlib.com/polygon/gentelella/css/custom.css" rel="stylesheet">
    <link href="https://colorlib.com/polygon/gentelella/css/icheck/flat/green.css" rel="stylesheet">

    <link href="assets/css/fullcalendar.css" rel="stylesheet">
    <link href="assets/css/fullcalendar.print.css" rel="stylesheet" media="print">

    <script src="https://colorlib.com/polygon/gentelella/js/jquery.min.js"></script>
    @endsection


    @section('contenu')
            <!-- page content -->
    <div class="right_col" role="main">
        <div class="">

            <div class="page-title">
                <div class="title_left">
                    <h3>
                       Votre calendrier
                    </h3>
                </div>


            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Vos travaux prevus</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <div id='calendar'></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Ajout d&#8216;un &#233;venement</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <form class="form-horizontal form-label-left" novalidate  method="post" action="{{ route('adding') }}" >


                                <span class="section">Informations</span>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Titre :  <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" id="exampleSelect1" name="work">
                                            @foreach($works as $work)
                                            <option>{{$work['name']}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Date a prevoir :<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="date" id="date" name="date" required="required" value="<?php echo date('Y-m-d'); ?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Heure :<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="time" id="time" name="time" value="<?php date_default_timezone_get('Europe/Berlin');
                                        echo date('H:i', time()+7200);
                                        ?>" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button id="send" type="submit" class="btn btn-success">Ajouter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /page content -->

    <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
    <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>

    <!-- End Calendar modal -->
    <!-- /page content -->
    </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="https://colorlib.com/polygon/gentelella/js/bootstrap.min.js"></script>

    <script src="https://colorlib.com/polygon/gentelella/js/nprogress.js"></script>

    <!-- bootstrap progress js -->
    <script src="https://colorlib.com/polygon/gentelella/js/progressbar/bootstrap-progressbar.min.js"></script>

    <!-- icheck -->
    <script src="https://colorlib.com/polygon/gentelella/js/icheck/icheck.min.js"></script>

    <script src="https://colorlib.com/polygon/gentelella/js/custom.js"></script>

    <script src="https://colorlib.com/polygon/gentelella/js/moment/moment.min.js"></script>
    <script src="assets/js/fullcalendar.js"></script>

    <script>
        $(window).load(function() {

            var calendar = $('#calendar').fullCalendar({

                editable: true,
                events: [<?php echo $events?>]
            });
        });
    </script>
            @endsection


