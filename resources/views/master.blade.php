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
      <div id="app" style="display: flex; flex-direction: column">
        <router-view style="flex: 1"></router-view>
        <footer class="footer">
          <div class="container">
            <div class="content has-text-centered">
              <p>
                <strong>Quiz</strong> by <a href="http://github.com/tomaszrup">Tomasz Rup</a>.
              </p>
            </div>
          </div>
        </footer>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.4.3/velocity.min.js"></script>
      <script src="/js/app.js"></script>
    </body>
</html>
