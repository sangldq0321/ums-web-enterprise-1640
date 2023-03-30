@extends('layouts.main')
@if (Auth::user()->roleID===1)
@section('title','Dashboard')
@elseif (Auth::user()->roleID!==1)
@section('title','Home')
@endif
@section('content')
@if(Auth::user()->roleID==1)
<h3 class="text-center fw-bold">Dashboard</h3>
@else
<div class="row">
    <div class="col-12 col-lg-9">
        @if(Auth::user()->roleID!==1)
        @foreach ($ideas as $idea)
        <div class="card mb-3">
            {{-- <img src="..." class="card-img-top" alt="..."> --}}
            <div class="card-body">
                <h1 class="card-title fw-bold">{{$idea->ideaName}}</h1>
                <div class="card-text">
                    <div>Category: <b>{{$categoryName}}</b></div>
                    <div>Upload by: <b>Anonymous</b> at
                        <?php $date=date_create($idea->created_at);
            echo date_format($date,"h:i A d/m/Y");
            ?>
                    </div>
                    </p>
                    <a href="/ideas/view/{{$idea->ideaID}}" class="btn btn-primary m-2">View more<i
                            class="fa-solid fa-angle-right ms-2"></i></a>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
    <div class="col-12 col-lg-3 mt-3 mt-lg-0">
        <div class="card w-100 mb-3">
            <div class="card-body">
                <h5 class="card-title fw-bold">User</h5>
                <p class="card-text">
                    @foreach ($users->where('roleID',Auth::user()->roleID) as $user)
                    @if($user->fullname==Auth::user()->fullname) {{$user->fullname}} (You) @endif
                    @endforeach
                </p>
            </div>
        </div>
        <div class="card w-100 mb-3">
            <div class="card-body">
                <h5 class="card-title fw-bold">Most popular idea</h5>
                <p class="card-text">Placeholder</p>
            </div>
        </div>
        <div class="card w-100 mb-3">
            <div class="card-body">
                <h5 class="card-title fw-bold">Most viewed idea</h5>
                <p class="card-text">Placeholder</p>
            </div>
        </div>
        <div class="card w-100 mb-3">
            <div class="card-body">
                <h5 class="card-title fw-bold">Latest idea</h5>
                <p class="card-text">
                <div class="fw-bold h5"><a href="/ideas/view/{{$idea->ideaID}}">{{$latestIdea->ideaName}}</a></div>
                <div>
                    <?php
                    $date=date_create($latestIdea->created_at);
                    echo date_format($date,"h:i A d/m/Y");
                    ?>
                </div>
                </p>
            </div>
        </div>
        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title fw-bold">Latest comment</h5>
                <p class="card-text">
                    @if ($countComment==0)
                <div>There is no comment yet !</div>
                @else
                <div class="h6 fw-bold">Anonymous:</div>
                <div>
                    <?php
                    $date=date_create($latestComment->created_at);
                    echo date_format($date,"h:i A d/m/Y");
                    ?>
                </div>
                @endif
                </p>
            </div>
        </div>
    </div>
</div>
@endif
<style>
    .card {
        transition: box-shadow 0.5s;
    }

    .card:hover {
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        transition: box-shadow 0.5s;
    }
</style>
@endsection
