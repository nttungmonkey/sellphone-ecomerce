<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title')</title>
        <!-- Tempusdominus Bbootstrap 4 -->
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/tempusdominus-bootstrap-4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('themes/limupa/css/login.css') }}">
    </head>
    <body>
        <div class="login-reg-panel">
            <div class="login-info-box">
                <h2>Have an account?</h2>
                <p>Lorem ipsum dolor sit amet</p>
                <label id="label-register" for="log-reg-show">Login</label>
                <input type="radio" name="active-log-panel" id="log-reg-show"  checked="checked">
            </div>
                                
            <div class="register-info-box">
                <h2>Don't have an account?</h2>
                <p>Lorem ipsum dolor sit amet</p>
                <label id="label-login" for="log-login-show">Register</label>
                <input type="radio" name="active-log-panel" id="log-login-show">
            </div>
                                
            <div class="white-panel">
                <div class="login-show">
                    <h2>LOGIN</h2>
                    <form id="form" class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <input id="acc_user" name="acc_user" value="{{ old('acc_user') }}" required autofocus type="text" placeholder="Username">
                        @if ($errors->has('acc_user'))
                            <span class="help-block {{ $errors->has('acc_user') ? ' has-error' : '' }}">
                                <strong>{{ $errors->first('acc_user') }}</strong>
                            </span>
                        @endif
                        <input id="acc_password" name="acc_password" required type="password" placeholder="Password">
                        @if ($errors->has('acc_user'))
                            <span class="help-block {{ $errors->has('acc_password') ? ' has-error' : '' }}">
                                <strong>{{ $errors->first('acc_password') }}</strong>
                            </span>
                        @endif
                        <input type="submit" value="Login"> 
                        <label>
                            <input type="checkbox" name="acc_remember" {{ old('acc_remember') ? 'checked' : '' }}> Remember me!
                        </label>              
                        <a href="{{ route('password.request') }}">Forgot password?</a>
                    </form>
                </div>
                <div class="register-show">
                    <h2>REGISTER</h2>
                    <input type="text" placeholder="Email">
                    <input type="password" placeholder="Password">
                    <input type="password" placeholder="Confirm Password">
                    <input type="button" value="Register">
                </div>
            </div>
        </div>
    </body>
    <!-- jQuery -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>

        $(document).ready(function(){
            $('.login-info-box').fadeOut();
            $('.login-show').addClass('show-log-panel');

            

        });


        $('.login-reg-panel input[type="radio"]').on('change', function() {
            if($('#log-login-show').is(':checked')) {
                $('.register-info-box').fadeOut(); 
                $('.login-info-box').fadeIn();
                
                $('.white-panel').addClass('right-log');
                $('.register-show').addClass('show-log-panel');
                $('.login-show').removeClass('show-log-panel');
                
            }
            else if($('#log-reg-show').is(':checked')) {
                $('.register-info-box').fadeIn();
                $('.login-info-box').fadeOut();
                
                $('.white-panel').removeClass('right-log');
                
                $('.login-show').addClass('show-log-panel');
                $('.register-show').removeClass('show-log-panel');
            }
        });
    </script>
</html>

