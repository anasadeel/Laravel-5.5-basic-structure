@extends('admin/admin_template')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        @include('admin/commons/errors')    
        <!-- /.box -->
        <!-- general form elements disabled -->
        <div class="box box-default">

            <div class="box-header with-border">
                <h3 class="box-title">Edit User</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::open(array( 'class' => 'form','url' => 'admin/user/update', 'files' => true)) !!}
                <!-- text input -->           
                @include('admin.users.form')
                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>

@endsection