<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UMS - Login</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.3.0/js/all.min.js"
        integrity="sha256-+rLIGHyZHBDebNqckORMwB+/ueJuy2RqFcYAYlhjkCs=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">
    <style>
        body::before {
            content: "";
            position: absolute;
            z-index: -1;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: url('/assets/img/login-bg.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body class="h-100 d-flex align-items-center justify-content-center position-relative p-3" style="z-index: 1;">
    <div class="w-100 rounded-3 bg-light text-dark p-3 shadow" style="max-width: 512px;">
        <form action="/login" method="POST">
            <h4 class="text-center fw-bold mb-3">Login</h4>
            @csrf
            @if (count($errors) > 0)
            <div class="d-flex justify-content-center mb-3">
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $err)
                    <div><i class="fa-solid fa-triangle-exclamation me-2"></i>{{ $err }}</div>
                    @endforeach
                </div>
            </div>
            @endif
            @if(session('notify')=='logoutsuccess')
            <div class="d-flex justify-content-center mb-3">
                <div class="alert alert-success">
                    <span>Log out success</span>
                </div>
            </div>
            @endif
            @if(session('notify')=='loginfailed')
            <div class="d-flex justify-content-center mb-3">
                <div class="alert alert-danger">
                    <span>Log in failed</span>
                </div>
            </div>
            @endif
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username">
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                    name="password">
                <label for="floatingPassword">Password</label>
            </div>
            <button type="submit" class="btn btn-success d-block mx-auto">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
