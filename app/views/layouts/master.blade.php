<!doctype html>
<html>
<head>
  <title>Seattle Free School</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/static/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/static/css/base.css" />
  <script src="/static/js/jquery-1.10.2.min.js"></script>
  <script src="/static/js/bootstrap.min.js"></script>
  <script src="/static/js/sfs.js"></script>
</head>
<body>
  <div class="container content">
    @include('page.header')
    @include('page.messages')
    @section('content')

    @show
  </div>
  @include('page.footer')
</body>
</html>