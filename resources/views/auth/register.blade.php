<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ICLC System</title>

    <!-- Styles -->
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
        <div>
            <h1 style="color: white; text-align: : left; font-size: 100px; font-family: Arial Black, Gadget, sans-serif  ">ICLC</h1><hr>  
               <h1 style="color: white; text-align: : left">Payment System</h1>
            </div>
        <div class="login-box">
            <div class="login-content">
                <form class="login-form" role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>REGISTER</h3>
                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <label for="first_name" class="control-label">First Name</label>
                        <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>
                    </div>

                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label for="last_name" class="control-label">Last Name</label>
                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('first_name') }}" required autofocus>
                    </div>

                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <label for="username" class="control-label">Username</label>
                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>
                    </div>

                    <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                        <label for="position" class="control-label">Position</label>
                        <input id="position" type="text" class="form-control" name="position" value="{{ old('position') }}" required>

                        @if ($errors->has('position'))
                            <span class="help-block">
                                <strong>{{ $errors->first('position') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">Password</label>
                        <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="control-label">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
<script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('js/essential-plugins.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/plugins/pace.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
</html>