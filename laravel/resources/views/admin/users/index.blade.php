@extends('admin/admin_template')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Users
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-xs-12">
        @include('admin/commons/errors')
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Search Form</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>   
                </div>
            </div>

            <form class="form" role="form" id="filter">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('First Name') !!}
                                {!! Form::text('firstName',(isset($firstName))?$firstName:'', array('class' => 'form-control', 'id' => 'firstName') ) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('Last Name') !!}
                                {!! Form::text('lastName',(isset($lastName))?$lastName:'', array('class' => 'form-control', 'id' => 'lastName') ) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('email') !!}
                                {!! Form::text('email',(isset($email))?$email:'', array('class' => 'form-control', 'id' => 'email') ) !!}
                            </div>
                        </div>
<!--                        <div class="form-group col-sm-6">
                            <label for="filter">Type</label>
                            <select class="form-control" name="role_id" id="role_id">
                                <option value="" selected>All </option>
                                <option value="2" {{ (isset($role_id) && $role_id == '2')?'selected':'' }}>Paid</option>
                                <option value="3" {{ (isset($role_id) && $role_id == '3')?'selected':'' }}>Non Paid</option>
                            </select>
                        </div>-->
                        <div class='clearfix'></div>
                        <input type="hidden" class="form-control" name="page" id="page" value="<?php echo $page; ?>"/>
                        <div class='clearfix'></div>
                        <div class="form-group col-sm-6">
                            <button type="submit" class="btn btn-primary btn-flat btn-block">Search</button>
                        </div>
                        <div class="form-group col-sm-6">
                            <a href="{{ url('admin/users') }}" class="btn btn-danger btn-block btn-flat">Clear Search</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <!-- Left col -->
    <div class="col-md-12 col-xs-12">

        <div class="box box-default" id="user_listing">

        </div>

    </div>
</div>
</section>
<script>
    jQuery('.delete').click(function ()
    {
        $('#closemodal').attr('href', $(this).data('link'));
    });
</script>
<script>
    $(document).ready(function () {
        userListing();
    });
    $("form").submit(function (e) {
        userListing();
        e.preventDefault();

    });
//    $("form").change(function (e) {
//        userListing();
//        e.preventDefault();
//    });
//    $("#firstName, #lastName, #email").keyup(function (e) {
//        userListing();
//    });

    function userListing() {
        var formdata = $("#filter").serialize();
        $.ajax({
            url: "<?php echo url('admin/users/listing'); ?>",
            type: 'get',
            dataType: 'html',
            data: formdata,
            success: function (response) {
                $('#user_listing').html(response);
            },
            error: function (xhr, status, response) {
            }
        });
    }
</script>
@endsection
