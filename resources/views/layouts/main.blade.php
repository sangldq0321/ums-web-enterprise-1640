<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>UMS - @yield('title')</title>
    <script src="/assets/js/jquery.min.js"></script>
    <link rel="stylesheet" href="/assets/css/all.min.css">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/main.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css"
        integrity="sha256-sWZjHQiY9fvheUAOoxrszw9Wphl3zqfVaz1kZKEvot8=" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"
        integrity="sha256-t0FDfwj/WoMHIBbmFfuOtZv1wtA977QCfsFR3p1K4No=" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">
</head>

<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar navbar-expand-lg" style="border-bottom:4px solid #f27228;">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="/">UMS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            @if(Auth::user()->roleID===1)
                            <a class="nav-link" href="/">Dashboard</a>
                            @elseif(Auth::user()->roleID!==1)
                            <a class="nav-link" href="/">Home</a>
                            @endif
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        @auth
                        @if (Auth::user()->roleID!==1)
                        <li class="nav-item">
                            <a class="nav-link" href="/ideas">Ideas</a>
                        </li>
                        @endif
                        @if (Auth::user()->roleID==1)
                        <li class="nav-item">
                            <a class="nav-link" href="/categories">Categories</a>
                        </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><span class="me-2">{{
                                    Auth::user()->fullname }}</span></a>
                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                <li><a class="dropdown-item" href="/account/change-password">Change password</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="/logout"><i
                                            class="fa-solid fa-right-from-bracket me-2"></i>Log out</a>
                                </li>
                            </ul>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="flex-shrink-0">
        <div class="container my-3">
            @yield('content')
        </div>
    </main>
    <footer class="mt-auto text-light" style="border-top:4px solid #f27228;">
        <div class="container py-3">
            <div class="text-center">&copy 2023 <b>UMS</b>. All rights reserved.</div>
        </div>
    </footer>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script>
        $(function () {
    var path = window.location.href;
    $('body header nav a.nav-link').each(function () {
        if (this.href === path) {
            $(this).addClass('active fw-bold');
        }
    });
});
$(function () {
    $('a').click(function (e) {
        var targetHref = $(this).prop('href');
        var currentHref = window.location.href;
        if (targetHref == currentHref) {
            e.preventDefault();
        }
    })
});
    </script>
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/fc-4.2.2/fh-3.3.2/r-2.4.1/sc-2.1.1/sp-2.1.2/datatables.min.css"
        rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/fc-4.2.2/fh-3.3.2/r-2.4.1/sc-2.1.1/sp-2.1.2/datatables.min.js">
    </script>
</body>

</html>
