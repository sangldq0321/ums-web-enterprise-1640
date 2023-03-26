@extends('layouts.main')
@if (Auth::user()->roleID===1)
@section('title','Dashboard')
@elseif (Auth::user()->roleID!==1)
@section('title','Home')
@endif
@section('content')
@if(Auth::user()->roleID===1)
<h3 class="text-center"><i></i>Dashboard</h3>
@endif
@if(Auth::user()->roleID!==1)
<h3 class="text-center">Homepage</h3>
@endif
@endsection
