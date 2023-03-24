@extends('layouts.main')
@section('content')
<h4 class="text-center fw-bold mb-3">Login</h4>
<form action="/login" method="POST">
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
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
        <label for="floatingPassword">Password</label>
    </div>
    <button type="submit" class="btn btn-success d-block mx-auto">Login</button>
</form>
@endsection
