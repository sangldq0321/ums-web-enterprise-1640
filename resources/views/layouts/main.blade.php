<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>UMS - @yield('title')</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.3.0/js/all.min.js"
        integrity="sha256-+rLIGHyZHBDebNqckORMwB+/ueJuy2RqFcYAYlhjkCs=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/main.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css"
        integrity="sha256-sWZjHQiY9fvheUAOoxrszw9Wphl3zqfVaz1kZKEvot8=" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"
        integrity="sha256-t0FDfwj/WoMHIBbmFfuOtZv1wtA977QCfsFR3p1K4No=" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="/assets/img/logo.ico" type="image/x-icon">
</head>

<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar navbar-expand-lg fixed-top shadow" style="border-bottom:4px solid #f27228;">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="/"><span class="d-flex align-items-center"><img
                            src="/assets/img/logo.svg" width="32px" class="me-2"><span>UMS</span></span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @if(Auth::user()->roleID===1)
                        <li class="nav-item">
                            <a class="nav-link" href="/"><i class="fa-solid fa-chart-line me-2"></i>Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/ideas/acayear"><i class="fa-solid fa-clock me-2"></i></i>Academic
                                year</a>
                        </li>
                        @elseif(Auth::user()->roleID!==1)
                        <a class="nav-link" href="/"><i class="fa-solid fa-building-columns me-2"></i>Home</a>
                        @endif
                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        @auth
                        @if (Auth::user()->roleID==3 ||Auth::user()->roleID==4 )
                        <li class="nav-item">
                            <a class="nav-link" href="/ideas">Ideas</a>
                        </li>
                        @endif
                        @if (Auth::user()->roleID==2)
                        <li class="nav-item">
                            <a class="nav-link" href="/categories">Categories</a>
                        </li>
                        @endif
                        @if(Auth::user()->roleID!==1 && Auth::user()->roleID!==2)
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="javascript:void(0)" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false"><i class="fa-solid fa-bell"></i></a>
                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                <li>
                                    <h6 class="dropdown-header fw-bold">Notifications</h6>
                                </li>
                                @if($notis->isNotEmpty())
                                @foreach ($notis as $noti)
                                @if($noti->notiFor=='comment')
                                @if($noti->userID == Auth::user()->userID)
                                <li>
                                    <a class="dropdown-item">
                                        <div class="text-start">{{$noti->notiContent}}</div>
                                        <div class="text-end">
                                            <?php $date = date_create($noti->created_at);
                                            echo date_format($date, 'h:i A d/m/Y');
                                            ?>
                                        </div>
                                        <form method="POST" action="/noti/read/{{ $noti->notiID }}">
                                            @csrf
                                            <input name="_method" type="hidden" value="GET">
                                            <div class="text-end mt-2"><button class="btn btn-success btn-sm">Mark as
                                                    read</button></div>
                                        </form>
                                    </a>
                                </li>
                                @else
                                <a class="dropdown-item">
                                    <div>Notification is empty !</div>
                                </a>
                                @endif
                                @endif
                                @endforeach
                                @else
                                <a class="dropdown-item">
                                    <div>Notification is empty !</div>
                                </a>
                                @endif
                            </ul>
                        </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-bold" href="javascript:void(0)" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><span class="me-2">{{
                                    Auth::user()->fullname }}</span></a>
                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                @if (Auth::user()->roleID!=1 )
                                <li>
                                    <h6 class="dropdown-header fw-bold">Account</h6>
                                </li>
                                <li><a class="dropdown-item" href="/account/view-profile/{{Auth::user()->userID}}"><i
                                            class="fa-solid fa-user me-2"></i>View profile</a>
                                </li>
                                <li>
                                    <h6 class="dropdown-header fw-bold">Setting</h6>
                                </li>
                                <li><a class="dropdown-item" href="/account/edit-profile/{{Auth::user()->userID}}"><i
                                            class="fa-solid fa-user-pen me-2"></i>Edit profile</a>
                                </li>
                                <li><a class="dropdown-item" href="/account/change-password"><i
                                            class="fa-solid fa-lock me-2"></i>Change password</a>
                                </li>
                                @endif
                                <li>
                                    <h6 class="dropdown-header fw-bold">Log out</h6>
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
        <div class="container-fluid my-3">
            <div class="mx-3">
                @yield('content')
            </div>
        </div>
    </main>
    <footer class="mt-auto text-light" style="border-top:4px solid #f27228;">
        <div class="container py-3">
            <img src="/assets/img/logo.svg" width="48px" class="mb-2 d-block mx-auto">
            <div class="text-center">&copy 2023 <b>UMS</b>. All rights reserved.</div>
        </div>
    </footer>
    <button class="top-btn shadow" onclick="topFunction()" id="topBtn"><i class="fa-solid fa-chevron-up"></i></button>
    @if (session('notify') == 'loginsuccess')
    <script>
        Swal.fire({
            title: 'Login success',
            icon: 'success',
            timer: 2000,
            showConfirmButton: false,
            allowOutsideClick: false,
        })
    </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/fc-4.2.2/fh-3.3.2/r-2.4.1/sc-2.1.1/sp-2.1.2/datatables.min.css"
        rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/fc-4.2.2/fh-3.3.2/r-2.4.1/sc-2.1.1/sp-2.1.2/datatables.min.js">
    </script>
    <script src="/assets/js/main.js"></script>
</body>

</html>
