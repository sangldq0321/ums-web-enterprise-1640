@extends('layouts.main')
@section('title','Change password')
@section('content')
<h4 class="text-center fw-bold mb-3">Edit profile</h4>
<form action="/account/edit-profile/{{Auth::user()->userID}}" method="POST">
    @csrf
    @if ($errors->any())
    <div class="d-flex justify-content-center mb-3">
        <div class="alert alert-danger">
            @foreach ($errors->all() as $err)
            <div><i class="fa-solid fa-triangle-exclamation me-2"></i>{{ $err }}</div>
            @endforeach
        </div>
    </div>
    @endif
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="floatingEmail" placeholder="Email" name="email" value="{{Auth::user()->email}}">
        <label for="floatingEmail">Email</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingFullname" placeholder="Fullname" name="fullname" value="{{Auth::user()->fullname}}">
        <label for="floatingFullname">Fullname</label>
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
            text: 'Are you sure to update this password ?',
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
