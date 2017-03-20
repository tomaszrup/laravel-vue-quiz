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
      <div id="app" class="flex-column">
         @yield('content')
      </div>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.4.3/velocity.min.js"></script>
    <script src="/js/login/app.js"></script>
</html>
