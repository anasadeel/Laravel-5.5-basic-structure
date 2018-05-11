@extends('admin.admin_template')
@section('content')
  <div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4"  style="margin-top: 100px">
         <div class="flash-message">
      @foreach (['danger', 'warning', 'success', 'info','primary'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
       @endif
       @endforeach
       </div> <!-- end .flash-message -->
        <div class="login-logo">
        <a href=""><b>Admin</b>UJAMA</a>
        </div>
            <div class="panel panel-default" style="height: 350px;">
                <!-- <div class="panel-heading">Login Admin</div> -->
           
                <div class="panel-body">
                <p class="login-box-msg">Login to start your session</p>

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/login') }}" style="margin-top: 40px">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback ">
                            <!-- <label for="email" class="col-md-4 control-label">E-Mail Address</label> -->

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" placeholder="Your Email" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                             <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                            <!-- <label for="password" class="col-md-4 control-label">Password</label> -->

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" placeholder="Your Password" name="password" required>
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><br><br>
<!-- 
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Login
                                </button>

                                <!-- <a class="btn btn-link" href="{{ url('admin_password/reset') }}"> -->
                                <a class="btn btn-link" href="#">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection