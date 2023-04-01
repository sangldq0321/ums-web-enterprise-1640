@extends('layouts.main')
@section('title','Add idea')
@section('content')
<a href="/" type="button" class="btn btn-dark mb-3"><i class="fa-solid fa-chevron-left me-2"></i>Back</a>
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
    <button type="submit" class="btn btn-success d-block mx-auto edit_confirm" data-toggle="tooltip">Save</button>
</form>
<script script type="text/javascript">
    $('.edit_confirm').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure ?',
            text: 'Are you sure to update this comment ?',
            icon: 'question',
            showCancelButton: true,
            scrollbarPadding: false,
            allowOutsideClick: false,
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
