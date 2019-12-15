<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>
    <!-- Custom fonts for this template-->
    <link href="/sbAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="/sbAdmin/css/sb-admin.css" rel="stylesheet">
</head>
<body class="bg-dark">
    <div class="container">
        @if ($msgType != '')
            <div class="col-8 mx-auto mt-3">
                <div class="alert alert-{{$msgType}} alert-dismissible fade show" role="alert">
                    <strong>{{ucwords($msgType)}}</strong> {{$msgStr}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form action="/login" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="username" name="username" class="form-control" placeholder="Username"
                                required="required" autofocus="autofocus">
                            <label for="username">Username</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                                required="required">
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </button>
                </form>
                <div class="text-center">
                    <a class="d-block small mt-3" href="/register">Buat Akun</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/sbAdmin/vendor/jquery/jquery.min.js"></script>
    <script src="/sbAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/sbAdmin/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
