@extends('layouts.main')
@section('title','Add idea')
@section('content')
<a href="/ideas" type="button" class="btn btn-dark mb-3"><i class="fa-solid fa-chevron-left me-2"></i>Back</a>
<form action="/comments/edit/{{$comment->commentID}}" method="POST">
    <h4 class="text-center fw-bold mb-3">Edit comment</h4>
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
    <div class="form-floating mb-3">
        <input type="text" class="form-control" placeholder="Comment" name="commentContent"
            value="{{$comment->commentContent}}">
        <label>Comment</label>
    </div>
    <button type="submit" class="btn btn-success d-block mx-auto">Save</button>
</form>
@endsection
