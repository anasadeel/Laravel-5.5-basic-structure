<?php
$required = "required";
?>
@include('admin/commons/errors')

<div class="form-group">
    {!! Form::label('Parent Category') !!}
    {!! Form::select('parent_id', $categories,null,array('class' => 'form-control','required')) !!}
</div>

<div class="form-group">
    {!! Form::label('Name') !!}
    {!! Form::text('name', null , array('class' => 'form-control',$required) ) !!}

</div>
<div class="form-group">
    {!! Form::label('body') !!}
    {!! Form::textarea('description', null, ['size' => '105x25','class' => 'form-control ckeditor',$required]) !!} 
</div>

<div class="form-group">
    {!! Form::label('teaser') !!}
    {!! Form::textarea('teaser', null, ['size' => '105x3','class' => 'form-control']) !!} 

</div>

<div class="form-group">
    {!! Form::label('class') !!}
    {!! Form::text('class', null , array('class' => 'form-control') ) !!}
</div>

<!--
<div class="form-group">
    {!! Form::label('url') !!}
    {!! Form::text('url', null , array('class' => 'form-control',$required) ) !!}
</div>
-->

<div class="form-group">
    {!! Form::label('image') !!}
    {!! Form::file('image', null, 
    array('class'=>'form-control')) !!}
</div>

<div class="form-group">
    <div class="col-sm-4">
        <button type="submit" value="products" class="btn btn-primary btn-block btn-flat">Save</button>
    </div>
    <div class="col-sm-4">
        <a href="{{ url('admin/categories')}}" class="btn btn-warning btn-block btn-flat">Cancel</a>
    </div>
</div>