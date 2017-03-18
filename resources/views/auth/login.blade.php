<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Quiz</title>

        <!-- Styles -->
        <link rel="stylesheet" href="/css/app.css">
        <script type="text/javascript">
          window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
          ]) !!};
        </script>
    </head>
    <body>
      <div id="app">
        <welcome inline-template>
          <div class="login-page">
            <div class="container">
              <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                  {{ csrf_field() }}

                  <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
                      <label for="login" class="col-md-4 control-label">Login</label>

                      <div class="col-md-6">
                          <input id="login" type="text" class="form-control" name="login" value="{{ old('login') }}" required autofocus>

                          @if ($errors->has('login'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('login') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      <label for="password" class="col-md-4 control-label">Password</label>

                      <div class="col-md-6">
                          <input id="password" type="password" class="form-control" name="password" required>

                          @if ($errors->has('password'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-6 col-md-offset-4">
                          <div class="checkbox">
                              <label>
                                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                              </label>
                          </div>
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-8 col-md-offset-4">
                          <button type="submit" class="btn btn-primary">
                              Login
                          </button>

                          <a class="btn btn-link" href="{{ route('password.request') }}">
                              Forgot Your Password?
                          </a>
                      </div>
                  </div>
              </form>
            </div>
          </div>
        </welcome>
      </div>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.4.3/velocity.min.js"></script>
      <script src="/js/login/app.js"></script>
    </body>
</html>
