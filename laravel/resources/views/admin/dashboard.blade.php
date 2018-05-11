@extends('admin/admin_template')

@section('content')
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))

    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
    @endforeach
</div> <!-- end .flash-message -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-6 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>
                        {{ $totalUsers }}
                    </h3>
                    <p>
                        User Registrations
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-plus"></i>
                </div>
                <a href="{{ url('admin/users') }}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
        
        <!--        <div class="col-lg-3 col-xs-6">
                     small box 
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>
                                21
                            </h3>
                            <p>
                                Total Basic Subscriptions
                            </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-calendar-check-o"></i>
                        </div>
                        <a href="" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                 ./col 
        
                <div class="col-lg-3 col-xs-6">
                     small box 
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>
                                53
                            </h3>
                            <p>
                                Total Pro Subscriptions
                            </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-calendar-check-o"></i>
                        </div>
                        <a href="" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>-->
        <!-- ./col -->
    </div>
    <br><br>
    <div class="row">
        <div class="col-lg-8 col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Recently Added Users</h3>
                    <div class="box-tools">
                    </div>
                </div> 
                <div class="box-body table-responsive no-padding">
                    @if(count($recentUsers) > 0)
                    <table class="table table-hover">
                        <tbody><tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                            @foreach($recentUsers as $user)
                            <tr>
                                <td><a href="<?php echo url('admin/user/' . $user->id); ?>">{{$user->id}}</a></td>
                                <td><a href="<?php echo url('admin/user/' . $user->id); ?>">{{$user->firstName}} {{$user->lastName}}</a></td>
                                <td><span class="badge">{{ ($user->role_id == 2)? 'Paid' : 'Non Paid' }}</span></td>
                                <td>{{date('d/m/Y',strtotime($user->created_at))}}</td>
                                <?php
                                if ($user->status == 1) {
                                    $status = 'success';
                                    $text = 'Active';
                                } else {
                                    $status = 'danger';
                                    $text = 'Deactive';
                                }
                                ?>
                                <td><span class ="label label-{{$status}}">{{$text}}</span></td>
                            </tr>
                            @endforeach
                        </tbody></table>
                    @if(count($recentUsers) > 5)
                    <div class="box-footer text-center">
                        <a href="{{ URL('admin/users') }}" class="uppercase">View All</a>
                    </div>
                    @endif
                    @else
                    <div class="col-sm-6">
                        <h3>No data found. . . . </h3>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
