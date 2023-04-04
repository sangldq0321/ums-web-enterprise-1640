@extends('layouts.main')
@section('title', 'Edit Academic year')
@section('content')
<a href="/ideas/acayear" type="button" class="btn btn-dark mb-3"><i class="fa-solid fa-chevron-left me-2"></i>Back</a>
<form action="/ideas/acayear/edit/{{$acayear->academicYearName}}" method="post">
    @csrf
    <h3 class="text-center">Edit Academic Year</h3>
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
        <input type="text" class="form-control" placeholder="Academic Year Name" name="academicYearName"
            value="{{$acayear->academicYearName}}">
        <label>Academic year name</label>
    </div>
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label class="mb-2">Open Date</label>
                <input type="datetime-local" class="form-control" placeholder="Open Date" name="open_date"
                    value="{{$acayear->open_date}}">

            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label class="mb-2">Close Date</label>
                <input type="datetime-local" class="form-control" placeholder="Close date" name="close_date"
                    value="{{$acayear->close_date}}">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success d-block mx-auto edit_confirm">Save</button>
</form>
<script script type="text/javascript">
    $('.edit_confirm').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure ?',
            text: 'Are you sure to update this academic year ?',
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
