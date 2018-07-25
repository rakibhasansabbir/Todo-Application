<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <title>Laravel</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        
    </head>
    <body>
         <div class="jumbotron text-center">
        <h1>Hello User!</h1>
        <p>Welcome to our company</p>
        <p><a class="btn btn-primary btn-lg" href="/home" role="button">Admin</a>
            <a class="btn btn-success btn-lg" href="/manager" role="button">Manager</a>
        </p>
    </div>
    </body>
</html>
