@extends('layouts.main')
@section('title','Change password')
@section('content')
<h4 class="text-center fw-bold mb-3">Change password</h4>
<form action="/account/change-password" method="POST">
    @csrf
    @if ($errors->any())
    <div class="d-flex justify-content-center mb-3">
        <div class="alert alert-danger">
            @foreach ($errors->all() as $err)
            <div><i class="fa-solid fa-triangle-exclamation me-2"></i>{!! $err !!}</div>
            @endforeach
        </div>
    </div>
    @endif
    @if(Auth::user()->isPassReset==0)
    <div class="d-flex justify-content-center mb-3">
        <div class="alert alert-info">
            <div>You must <b>set up new password</b> to use the system !</div>
        </div>
    </div>
    @endif
    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
        <label for="floatingPassword">Password</label>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Confirm password"
            name="password_confirmation">
        <label for="floatingPassword">Confirm password</label>
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
