@extends('admin/admin_template')

@section('content')
<style>
    .user-detail-image img {
        height: 260px;
        width: 100%;
    }
</style>
<div class="row">
    <div class="col-md-12">
        @include('admin/commons/errors')
        <div class="box box-default">

            <div class="box-header with-border">
                <h3 class="box-title">Basic Information </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>

                </div>
            </div>

            <?php
            $user = $data[0];
            ?>        
            @if($user->status == '1')
            <div class="box-body bg-success">
                @else
                <div class="box-body bg-danger">
                    @endif
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="col-sm-12 user-detail-image">
                                @if($data[0]->image == '')
                                <img  src="{{ asset('front/images/usr.jpg')}}" alt="User Avatar">
                                @else
                                <img src="{{ asset('uploads/users/profile/'.$data[0]->image) }}" alt="User Avatar">
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>First Name :</td>
                                        <td>{{ $data[0]->firstName }}</td>
                                    </tr>
                                    <tr>
                                        <td>Last Name :</td>
                                        <td>{{ $data[0]->lastName }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email :</td>
                                        <td>{{ $data[0]->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>About :</td>
                                        <td>{{ $data[0]->about }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    @include('admin/commons/users_action')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <i class="fa fa-pie-chart"></i>
                    <h3 class="box-title">Social Media Statistics</h3>
                </div>
                <div class="box-body">
                    @if(count($users) > 0)
                    <div class="col-sm-5">
                        <ul class="nav nav-pills nav-stacked">
                            @foreach ($users as $value)
                            @foreach($sm as $s)
                            @if($s->code == $value->sm_code)
                            <li>
                                <a href="#">
                                    <h4>
                                        <i class="fa fa-square" style="color: <?php echo $s->color; ?>"></i> 
                                        <?php echo ucfirst($value->sm_code) ?> 
                                        <span class="badge pull-right" style="background-color:<?php echo $s->color; ?>">
                                            <?php echo $value->shares ?>
                                        </span>  
                                    </h4>
                                </a>
                            </li>
                            @endif
                            @endforeach
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <canvas id="pieChart" width="418" height="231"></canvas>
                    </div>
                    @else 
                    <h3 class="text-center">No data found . . . </h3>
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</div>
<script>
    jQuery('.delete').click(function ()
    {
        $('#closemodal').attr('href', $(this).data('link'));
    });
</script>
<script src="{{ asset('adminlte/plugins/chartjs/Chart.min.js')}}"></script>
<script>
//-------------
//- PIE CHART -
//-------------
// Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
    var pieChart = new Chart(pieChartCanvas);
    var PieData = [
<?php
foreach ($users as $value2) {
    foreach ($sm as $s) {
        if ($s->code == $value2->sm_code) {
            ?>
                    {
                        value: '<?php echo $value2->shares ?>',
                        color: '<?php echo $s->color ?>',
                        highlight: '<?php echo $s->color ?>',
                        label: '<?php echo ucfirst($value2->sm_code) ?>'
                    },
            <?php
        }
    }
}
?>
    ];
    var pieOptions = {
//Boolean - Whether we should show a stroke on each segment
        segmentShowStroke: true,
//String - The colour of each segment stroke
        segmentStrokeColor: '#fff',
//Number - The width of each segment stroke
        segmentStrokeWidth: 2,
//Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
//Number - Amount of animation steps
        animationSteps: 100,
//String - Animation easing effect
        animationEasing: 'easeOutBounce',
//Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
//Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: false,
//Boolean - whether to make the chart responsive to window resizing
        responsive: true,
// Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
//String - A legend template
        legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    };
//Create pie or douhnut chart
// You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);
</script>
@endsection
