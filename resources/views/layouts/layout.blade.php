<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BookWorm</title>

    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="/css/landing-page.css" rel="stylesheet">
</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-light bg-light static-top">
    <div class="container">
        <a class="navbar-brand" href="/">BookWorm</a>
        @if(auth::check())
            <div class="btn-group" role="group">
        <a class="btn btn-primary" type="submit" class="btn btn-primary" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"  href="/logout">Sign out</a>
        <a class="ml-1 btn btn-primary" href="/books">Favourites</a>
            </div>
        @else
            <div class="btn-group" role="group">
            <a class="btn btn-primary" href="/login">Sign in</a>
            <a class="ml-1 btn btn-primary" href="/signup">Sign up</a>
            </div>
            @endif
    </div>
</nav>

@yield('content')
@if(auth::check())
    <form id="logout-form" action="/logout" method="POST" style="display: none;">@csrf</form>
    @endif

@yield('pageRelatedjs')
<!-- Bootstrap core JavaScript -->
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



</body>

</html>
