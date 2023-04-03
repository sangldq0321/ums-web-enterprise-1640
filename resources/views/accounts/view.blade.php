@extends('layouts.main')
@section('content')
@section('title','View profile')
<div class="d-flex justify-content-center">
    <div class="card shadow bg-light text-dark">
        <div class=" card-header">
            <h3 class="fw-bold text-center mb-0">View profile</h3>
        </div>
        <div class="card-body">
            <div class="text-center">
                {{-- <div id="lightGallery">
                    <img src="/assets/avatar/{{ $user->avatar }}" class="card-img-top mb-3 d-block mx-auto"
                        style="width:50%;aspect-ratio: 1 / 1;" alt="Avatar" id="img-gallery">
                </div> --}}
                <div class="card-text">Username: <b>{{ $user->username }}</b></div>
                <div class="card-text">Email: <b>{{ $user->email }}</b></div>
                <div class="card-text">Fullname: <b>{{ $user->fullname }}</b></div>
            </div>
            @if($user->userID == Auth::user()->userID)
            <div class="d-flex justify-content-center">
                <a href="/account/edit-profile/{{ $user->userID }}" class="btn btn-warning mt-3"><i
                        class="fa-solid fa-user-pen me-2"></i>Edit profile</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
