@extends('layouts.main')
@section('title', 'Edit Idea Time Submit')
@section('content')
<a href="/idea/academicyear" type="button" class="btn btn-dark mb-3"><i class="fa-solid fa-chevron-left me-2"></i>Back</a>
<form action="/idea/academicyear/add/save" method="POST">
    <h4 class="text-center fw-bold mb-5">Add Time to Submit Idea</h4>
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
    <div class="form-floating mb-3 border border-dark rounded-2">
        <input type="text" class="form-control" placeholder="Semester" name="semester" value="{{$acaYear->semester}}">
        <label>Semester</label>
    </div>
    <div class="row col-cols-1 col-cols-lg-2 mb-5">
        <div class="col-6">
            <div class="form-floating mb-3 border border-dark rounded-2">
                <input type="datetime-local" class="form-control" placeholder="Semester" name="openDate" value="{{$acaYear->openDate}}">
                <label>Open Date</label>
            </div>
        </div>
        <div class="col-6">
            <div class="form-floating mb-3 border border-dark rounded-2">
                <input type="datetime-local" class="form-control" placeholder="Semester" name="closeDate" value="{{$acaYear->closeDate}}">
                <label>Close Date</label>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success d-block mx-auto w-25">Save</button>
</form>
@endsection
