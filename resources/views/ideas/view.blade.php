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
@if(!is_null($document))
<div class="mb-3">
    <div class="border border-dark rounded-3 p-2 d-inline-flex">
        <a href="/documents/{{$idea->document}}" download>{{$idea->document}}<i
                class="fa-solid fa-download ms-2"></i></a>
    </div>
</div>
@else
@endif
@if (Auth::check() && Auth::user()->roleID != 4 && Auth::user()->roleID != 5)
@else
<div class="text-start">
    <div class="border rounded-3 p-3 d-inline-flex">
        <form action="/ideas/like/{{ $idea->ideaID }}" method="POST" class="d-inline-block">
            @csrf
            <span><button type="submit" class="btn btn-success" title="Thumb up"><i
                        class="fa-solid fa-thumbs-up h5 mb-0 me-2"></i>Like</button></span>
        </form>
        <span class="mx-2 d-flex align-items-center">@if($idea->likeCount>0)<span class="text-success fw-bold">+
                {{$idea->likeCount}}</span>@elseif($idea->likeCount<0)<span class="text-danger fw-bold">
                {{$idea->likeCount}}</span>@else <span class="fw-bold">0</span> @endif</span>
        <form action="/ideas/dislike/{{ $idea->ideaID }}" method="POST" class="d-inline-block">
            @csrf
            <span><button class="btn btn-danger" type="submit" title="Thump down"><i
                        class="fa-solid fa-thumbs-down h5 mb-0 me-2"></i>Dislike</button></span>
        </form>
    </div>
</div>
@endif
@if ($idea->uploader == Auth::user()->userID)
<div class="dropdown mt-3">
    <a type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">More
    </a>
    <ul class="dropdown-menu">
        <li><a href="/ideas/edit/{{ $idea->ideaID }}" class="dropdown-item"><i
                    class="fa-solid fa-pen-to-square me-2"></i>Edit</a></li>
        <li>
            <form method="POST" action="/ideas/delete/{{ $idea->ideaID }}">
                @csrf
                <input name="_method" type="hidden" value="GET">
                <a type="button" class="show_delete dropdown-item" data-toggle="tooltip"><i
                        class="fa-solid fa-trash me-2"></i>Delete</a>
            </form>
        </li>
    </ul>
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
            @if ($comment->userID == Auth::user()->userID)
            <div class="dropdown mt-3">
                <a type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">More
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/comments/edit/{{ $comment->commentID }}" class="dropdown-item"><i
                                class="fa-solid fa-pen-to-square me-2"></i>Edit</a></li>
                    <li>
                        <form method="POST" action="/comments/delete/{{ $comment->commentID }}">
                            @csrf
                            <input name="_method" type="hidden" value="GET">
                            <a type="button" class="show_delete dropdown-item" data-toggle="tooltip"><i
                                    class="fa-solid fa-trash me-2"></i>Delete</a>
                        </form>
                    </li>
                </ul>
            </div>
            @endif
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
@if($passDate!=1)
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
@else
<div class="d-flex justify-content-center mb-3">
    <div class="alert alert-danger">
        <div><i class="fa-solid fa-triangle-exclamation me-2"></i>Can't <b>add comment</b>.</div>
    </div>
</div>
@endif
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
