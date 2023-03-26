@extends('layouts.main')
@section('title','Change password')
@section('content')
<h4 class="text-center fw-bold mb-3">Change password</h4>
<form action="/account/change-password" method="POST">
    @csrf
    @if ($errors->any())
    <div class="d-flex justify-content-center mb-3">
        <div class="alert alert-danger">
            @foreach ($errors->all() as $err)
            <div><i class="fa-solid fa-triangle-exclamation me-2"></i>{{ $err }}</div>
            @endforeach
        </div>
    </div>
    @endif
    @if(Auth::user()->isPassReset==0)
    <div class="d-flex justify-content-center mb-3">
        <div class="alert alert-info">
            <div>You must set up new password to use the system !</div>
        </div>
    </div>
    @endif
    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
        <label for="floatingPassword">Password</label>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Confirm password"
            name="password_confirmation">
        <label for="floatingPassword">Confirm password</label>
    </div>
    <button type="submit" class="btn btn-success d-block mx-auto">Save</button>
</form>
@endsection
