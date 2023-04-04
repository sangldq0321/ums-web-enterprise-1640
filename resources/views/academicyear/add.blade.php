@extends('layouts.main')
@section('title', 'Add Academic year')
@section('content')
<a href="/ideas/acayear" type="button" class="btn btn-dark mb-3"><i class="fa-solid fa-chevron-left me-2"></i>Back</a>
<form action="/ideas/acayear/add" method="post">
    @csrf
    <h3 class="text-center mb-3">Add Academic Year</h3>
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
        <input type="text" class="form-control" placeholder="Academic year name" name="academicYearName">
        <label>Academic Year Name</label>
    </div>
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label class="mb-2">Open date</label>
                <input type="datetime-local" class="form-control" placeholder="Open date" name="open_date">
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label class="mb-2">Close date</label>
                <input type="datetime-local" class="form-control" placeholder="Close date" name="close_date">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success d-block mx-auto"><i class="fa-solid fa-plus me-2"></i>Add</button>
</form>
@endsection
