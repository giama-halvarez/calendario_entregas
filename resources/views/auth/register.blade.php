<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{config('app.name')}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('assets/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('assets/plugins/iCheck/square/blue.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page" style="background-color: #f5f5f5;">
<div class="register-box">
  <div class="register-logo">
    Calendario Entregas
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Registrar Usuario</p>

    <form action="{{ route('register') }}" method="POST">
      @csrf
      <div class="form-group has-feedback @error('name') has-error @enderror">
        <input type="text" class="form-control" name="name" placeholder="Nombre y Apellido" value="{{ old('name') }}" required autocomplete="name" autofocus>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @error('name')
        <span class="help-block">{{ $message }}</span>
        @enderror
      </div>
      <div class="form-group has-feedback @error('email') is-invalid @enderror">
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @error('email')
        <span class="help-block">{{ $message }}</span>
        @enderror
      </div>
      <div class="form-group has-feedback @error('password') is-invalid @enderror">
        <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="new-password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @error('password')
        <span class="help-block">{{ $message }}</span>
        @enderror
      </div>
      <div class="form-group has-feedback @error('password_confirmation') is-invalid @enderror">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password" required autocomplete="new-password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        @error('password_confirmation')
        <span class="help-block">{{ $message }}</span>
        @enderror
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="{{asset('assets/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('assets/plugins/iCheck/icheck.min.js')}}"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
