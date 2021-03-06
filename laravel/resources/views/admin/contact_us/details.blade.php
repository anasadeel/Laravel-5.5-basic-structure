@extends('admin/admin_template')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->

        <!-- /.box -->
        <!-- general form elements disabled -->
        <div class="box box-default">
            @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success !</h4>
                {!! session('success') !!}
            </div>
            @endif
            <div class="box-header with-border">
                <h3 class="box-title">Contact Form Detail</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <div class="form-group">
                    <label>Name:</label>
                    <span>{!! $contactus->name !!} </span>      
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <span>{!! $contactus->email !!}</span>      
                </div>
                <div class="form-group">
                    <label>Phone Number:</label>
                    <span>{!! $contactus->phoneNumber !!}</span>      
                </div>
                <div class="form-group">
                    <label>Message:</label>
                    <span>{!! $contactus->message !!}</span>      
                </div>
                <div class="form-group">
                    <label>Created:</label>
                    <span>{!! $contactus->created_at !!}</span>      
                </div>
                <a href="{{url('admin/contact-us')}}" class="btn btn-default pull-right">Back</a>
            </div>


            <!-- /.box-body -->

        </div>
        <!-- /.box -->
    </div>
</div>

@endsection