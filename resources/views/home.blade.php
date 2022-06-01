@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <p class="text-primary"><i class="fal fa-angle-double-right">&nbsp;</i>Dashboard</p>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fas fa-calendar-plus text-primary"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">New Ticket <span class="float-right badge badge-success">New</span> </span>
                        <span class="info-box-number">
                        {{ $new }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="info-box mb-3">
                <span class="info-box-icon"><i class="fas fa-spinner text-info"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">WIP Ticket</span>
                    <span class="info-box-number">{{ $wip }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="info-box mb-3">
                <span class="info-box-icon"><i class="fa fa-reply text-success"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Answered Ticket</span>
                    <span class="info-box-number">{{ $answered }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="info-box mb-3">
                <span class="info-box-icon"><i class="fas fa-times text-danger"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Closed Ticket</span>
                    <span class="info-box-number">{{ $closed }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="chart-box box-primary">
                    <div class="chart-box-header with-border mb-3">
                        <p>Monthly Ticket Count</p>
                    </div>
                    <div class="chart-box-body">
                        <div class="chart">
                            <canvas id="areaChart" style="height:250px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-box box-info">
                    <div class="chart-box-header with-border mb-3">
                        <p>Monthly Crm Count</p>
                    </div>
                    <div class="chart-box-body">
                        <div class="chart">
                            <canvas id="lineChart" style="height:250px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('/vendor/chart/Chart.min.js') }}"></script>

<script>

( function ( $ ) {

var areaCharts = {
    init: function () {
        Chart.defaults.global.defaultFontFamily = 'Poppins';
        Chart.defaults.global.defaultFontColor = '#212529';

        this.ajaxGetPostMonthlyData();

    },

    ajaxGetPostMonthlyData: function () {
        var urlPath =  'http://' + window.location.hostname + '/get-post-chart-data';
        var request = $.ajax( {
            method: 'GET',
            url: "{{ route('api.ticketChart') }}"
    } );

        request.done( function ( response ) {
            areaCharts.createCompletedJobsChart( response );
        });
    },
    createCompletedJobsChart: function ( response ) {
        var ctx = document.getElementById("areaChart").getContext('2d');
        var myAreaChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: response.months, // The response got from the ajax request containing all month names in the database
                datasets: [{
                    label: "Tickets",
                    lineTension: 0.3,
                    backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                    ],
                    data: response.ticket_count_data // The response got from the ajax request containing data for the completed jobs in the corresponding months
                }],
            },
            options: {
                showScale               : true,
                scaleShowGridLines      : false,
                scaleGridLineColor      : 'rgba(0,0,0,.05)',
                scaleGridLineWidth      : 1,
                scaleShowHorizontalLines: true,
                scaleShowVerticalLines  : true,
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: response.max, // The response got from the ajax request containing max limit for y axis
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                        }
                    }],
                },
                bezierCurve             : true,
                bezierCurveTension      : 0.3,
                pointDot                : false,
                pointDotRadius          : 4,
                pointDotStrokeWidth     : 1,
                pointHitDetectionRadius : 20,
                datasetStroke           : true,
                datasetStrokeWidth      : 2,
                datasetFill             : true,
                legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                maintainAspectRatio     : true,
                responsive              : true
            }
        });
    }
};

areaCharts.init();

var lineCharts = {
    init: function () {
        Chart.defaults.global.defaultFontFamily = 'Poppins';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        this.ajaxGetPostMonthlyData();

    },

    ajaxGetPostMonthlyData: function () {
        var urlPath =  'http://' + window.location.hostname + '/get-post-chart-data';
        var request = $.ajax( {
            method: 'GET',
            url: "{{ route('api.crmChart') }}"
    } );

        request.done( function ( response ) {
            lineCharts.createCompletedJobsChart( response );
        });
    },
    createCompletedJobsChart: function ( response ) {
        var ctx = document.getElementById("lineChart");
        var myLineChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: response.months, // The response got from the ajax request containing all month names in the database
                datasets: [{
                    label: "Crms",
                    backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                    ],
                    data: response.crm_count_data // The response got from the ajax request containing data for the completed jobs in the corresponding months
                }],
            }
        });
    }
};

lineCharts.init();

} )( jQuery );
</script>

@endsection
