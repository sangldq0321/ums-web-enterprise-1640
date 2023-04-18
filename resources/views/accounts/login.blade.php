<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UMS - Login</title>
    <meta name="author" content="KSA">
    <meta name="description" content="UMS - a university management system." />
    <meta name="keywords" content="UMS, ums, idea, university" />
    <link rel="preconnect" href="https://www.umsystem.azdigi.blog">
    <link rel="dns-prefetch" href="https://www.umsystem.azdigi.blog">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdn.datatables.net">
    <link rel="dns-prefetch" href="https://cdn.datatables.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <meta name="google-site-verification" content="EuxK6cQuZWyf5q-LSH8fnxzJNWiwCzGwEOys8ZAOD-Q" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.3.0/js/all.min.js"
        integrity="sha256-+rLIGHyZHBDebNqckORMwB+/ueJuy2RqFcYAYlhjkCs=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css"
        integrity="sha256-sWZjHQiY9fvheUAOoxrszw9Wphl3zqfVaz1kZKEvot8=" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"
        integrity="sha256-t0FDfwj/WoMHIBbmFfuOtZv1wtA977QCfsFR3p1K4No=" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="/assets/img/logo.ico" type="image/x-icon">
    <style>
        body::before {
            content: "";
            position: absolute;
            z-index: -1;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: #2b3494;
        }

        body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown),
        html.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) {
            height: 100% !important;
            overflow-y: visible !important;
        }
    </style>
</head>

<body class="h-100 d-flex align-items-center justify-content-center position-relative p-3" style="z-index: 1;">
    <div class="w-100 rounded-3 bg-light text-dark p-3"
        style="max-width: 512px;border:4px solid #f27228;box-shadow: 10px 10px 5px rgb(255, 255, 255, 0.15);">
        <form action="/login" method="POST">
            <img src="/assets/img/logo.svg" alt="logo" class="d-block mx-auto" width="64px">
            <h4 class="text-center fw-bold mb-3">Welcome to UMS !</h4>
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

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username">
                <label for="floatingInput"><i class="fa-solid fa-user me-2"></i>Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                    name="password">
                <label for="floatingPassword"><i class="fa-solid fa-lock me-2"></i>Password</label>
            </div>
            <button type="submit" class="btn btn-success d-block mx-auto"><i
                    class="fa-solid fa-right-to-bracket me-2"></i>Login</button>
        </form>
    </div>
    @if (session('notify') == 'logoutsuccess')
    <script>
        Swal.fire({
                title: 'Logout success',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false,
                allowOutsideClick: false,
            })
    </script>
    @endif
    @if (session('notify') == 'loginfailed')
    <script>
        Swal.fire({
            title: 'Login failed',
            icon: 'error',
            scrollbarPadding: false,
            allowOutsideClick: false,
        })
    </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script>
        $('input').attr('autocomplete', 'off')
    </script>
</body>

</html>
