@extends('layouts.main')
@section('title', 'View idea')
@section('content')
<a href="/" type="button" class="btn btn-dark mb-3"><i class="fa-solid fa-chevron-left me-2"></i>Back</a>
<h1 class="fw-bold">{{ $idea->ideaName }}</h1>
<div>Category: <b>{{ $categoryName }}</b></div>
<div class="mb-3">Upload by: <b>Anonymous</b> at
    <?php
        $date = date_create($idea->created_at);
        echo date_format($date, 'h:i A d/m/Y');
        ?>
</div>
{!! $idea->ideaContent !!}
@if (Auth::check() && Auth::user()->roleID != 4 && Auth::user()->roleID != 5)
@else
<div class="text-start">
    <form action="/ideas/like/{{ $idea->ideaID }}" method="POST" class="d-inline-block">
        @csrf
        <span><button type="submit" class="btn btn-success" title="Thumb up"><i
                    class="fa-solid fa-thumbs-up h5 mb-0"></i></button></span>
    </form>
    <span class="mx-2"></span>
    <form action="/ideas/dislike/{{ $idea->ideaID }}" method="POST" class="d-inline-block">
        @csrf
        <span><button class="btn btn-danger" type="submit" title="Thump down"><i
                    class="fa-solid fa-thumbs-down h5 mb-0"></i></button></span>
    </form>
</div>
@endif
@if ((Auth::check() && Auth::user()->roleID == 4) || Auth::user()->roleID == 5)
<div class="mt-3">
    <a href="/ideas/edit/{{ $idea->ideaID }}" class="m-2 edit"><i class="fa-solid fa-pen-to-square me-2"></i>Edit</a>
    <form method="POST" action="/ideas/delete/{{ $idea->ideaID }}" class="d-inline-block">
        @csrf
        <input name="_method" type="hidden" value="GET">
        <a type="button" class="show_delete m-2 delete" data-toggle="tooltip"><i class="fa-solid fa-trash me-2"></i>Delete</a>
    </form>
</div>
@endif
<hr>
<h3 class="fw-bold">Comment</h3>
@if ($comments->isNotEmpty())
@foreach ($comments->where('ideaID', $idea->ideaID) as $comment)
<div class="card mb-3">
    <div class="card-body">
        <div class="card-title"><b>Anonymous:</b></div>
        <div class="card-text">{{ $comment->commentContent }}</div>
        <div class="mt-2">Comment at
            <?php $date = date_create($comment->created_at);
                        echo date_format($date, ' h:i A d/m/Y');
                        ?>
        </div>
        @if (Auth::check() && Auth::user()->roleID != 4 && Auth::user()->roleID != 5)
        @else
        <div class="mt-2">
            <a href="/comments/edit/{{ $comment->commentID }}" class="m-2"><i
                    class="fa-solid fa-pen-to-square me-2"></i>Edit</a>
            <form method="POST" action="/comments/delete/{{ $comment->commentID }}" class="d-inline-block m-2">
                @csrf
                <input name="_method" type="hidden" value="GET">
                <a type="button" class="show_delete_comment" data-toggle="tooltip"><i
                        class="fa-solid fa-trash me-2"></i>Delete</a>
            </form>
        </div>
        @endif
    </div>
</div>
@endforeach
@else
<div class="h5 text-center">This idea not have any comment !</div>
@endif
@if (Auth::check() && Auth::user()->roleID != 4 && Auth::user()->roleID != 5)
@else
<form action="/ideas/comment" method="post">
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
    <div class="form-floating my-3">
        <input type="text" class="form-control" placeholder="Comment content" name="commentContent">
        <label>Comment</label>
    </div>
    <button type="submit" class="btn btn-success">Post comment</button>
</form>
@endif
<script script type="text/javascript">
    $('.show_delete').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure ?',
                text: 'Are you sure to delete this idea ?',
                icon: 'question',
                showCancelButton: true,
                scrollbarPadding: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
</script>
<script script type="text/javascript">
    $('.show_delete_comment').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure ?',
                text: 'Are you sure to delete this comment ?',
                icon: 'question',
                showCancelButton: true,
                scrollbarPadding: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
</script>
@endsection
