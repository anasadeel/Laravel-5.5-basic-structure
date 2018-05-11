@extends('admin/admin_template')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        @include('admin/commons/errors')
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Add New {{ ucfirst($_GET['type']) }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::open(array( 'class' => 'form','url' => 'admin/content/insert', 'files' => true)) !!}
                <?php $page = 'admin.content.form' . $type; ?>
                @include($page)
                <input type="hidden" id="type" name="type" value="<?php echo $type; ?>" >
                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>

@endsection