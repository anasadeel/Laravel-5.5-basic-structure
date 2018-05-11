<?php
$required = "required";
?>
<div class="form-group">
    {!! Form::label('First Name') !!}
    {!! Form::text('firstName', $user->firstName , array('class' => 'form-control',$required) ) !!}
</div>
<div class="form-group">
    {!! Form::label('Last Name') !!}
    {!! Form::text('lastName', $user->lastName , array('class' => 'form-control',$required) ) !!}
</div>

<div class="form-group">
    {!! Form::label('email') !!}
    {!! Form::text('email', $user->email , array('class' => 'form-control','readonly') ) !!}
</div>
<div class="form-group">
    <label for="phone">Phone Number</label>
    <input type="text" class="form-control" name="phone" id="phone" placeholder="+353" value="{{$user->phone}}">
</div>
<label for="dateofbirth">Date of birth</label>
<div class="row">
    <div class="form-group fnc-select col-sm-4">
        {!! Form::selectRange('date',1,31,$user->date,['class' => 'form-control',$required]) !!}
    </div>
    <div class="form-group fnc-select col-sm-4">
        {!! Form::selectMonth('month',$user->month, ['class' => 'form-control',$required]) !!}
    </div>
    <div class="form-group fnc-select col-sm-4">
        {!! Form::selectRange('year',2016,1930,$user->year,['class' => 'form-control',$required])!!}
    </div>
</div>
<div class="form-group">
    <label for="aboutMe">About me</label>
    <textarea class="form-control" rows="5" name="about" id="aboutMe" placeholder="About me">{{$user->about}}</textarea>
</div>

<div class="form-group">
    <div class="col-sm-6">
        <input type="hidden" name="id" value="{{ $user_id }}">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
    </div>
    <div class="col-sm-6">
        <a href="{{ url('admin/users')}}" class="btn btn-default btn-block btn-flat">Back</a>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".select").select2();
    });
</script>