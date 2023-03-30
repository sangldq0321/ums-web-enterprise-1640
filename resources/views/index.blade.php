@extends('layouts.main')
@if (Auth::user()->roleID===1)
@section('title','Dashboard')
@elseif (Auth::user()->roleID!==1)
@section('title','Home')
@endif
@section('content')
@if(Auth::user()->roleID===1)
<h3 class="text-center">Dashboard</h3>
@endif
@if(Auth::user()->roleID!==1)
<h3 class="text-center mb-3">Homepage</h3>
@foreach ($ideas as $idea)
<div class="card">
    {{-- <img src="..." class="card-img-top" alt="..."> --}}
    <div class="card-body">
        <h1 class="card-title fw-bold">{{$idea->ideaName}}</h1>
        <div class="card-text">
            <div>Category: <b>{{$categoryName}}</b></div>
            <div>Upload by: <b>{{$fullname}}</b> at
                <?php
            $date=date_create($idea->created_at);
            echo date_format($date,"d/m/Y H:i:s A");
            ?>
            </div>
            </p>
            <a href="/ideas/view/{{$idea->ideaID}}" class="btn btn-primary m-2">View more</a>
        </div>
    </div>
    @endforeach
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
