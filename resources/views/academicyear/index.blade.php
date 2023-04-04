@extends('layouts.main')
@section('title', 'Academic year')
@section('content')
<h3 class="text-center">Academic year</h3>
@if (Auth::check() && Auth::user()->roleID =1)
<div class="d-flex justify-content-center mb-3">
    <a href="/ideas/acayear/add" class="btn btn-success"><i class="fa-solid fa-plus me-2"></i>Add</a>
</div>
@endif
<table id="datatable">
    <thead>
        <tr>
            <th scope="col">Academic Year Name</th>
            <th scope="col">Open Date</th>
            <th scope="col">Close Date</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($acayears as $acayear)
        <tr>
            <td scope="row">{{$acayear->academicYearName}}</td>
            <td>{{$acayear->open_date}}</td>
            <td>{{$acayear->close_date}}</td>
            <td class="text-center">
                <a href="/ideas/acayear/edit/{{$acayear->academicYearName}}" class="btn btn-warning"><i
                        class="fa-solid fa-pen-to-square me-2"></i>Edit</a>
            </td>
            <td class="text-center">
                <form method="POST" action="/ideas/acayear/delete/{{$acayear->academicYearName}}">
                    @csrf
                    <input name="_method" type="hidden" value="GET">
                    <button type="button" class="show_delete btn btn-danger" data-toggle="tooltip"><i
                            class="fa-solid fa-trash me-2"></i>Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $('#datatable').DataTable({
            dom: "<'row'<'col-sm-12'B>>" +
                "<'row my-2'<'col-sm-12 col-md-6 mb-2'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row my-2'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
            "responsive": true,
            "lengthChange": true,
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
    });
</script>
<script script type="text/javascript">
    $('.show_delete').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure ?',
            text: 'Are you sure to delete this academic year ?',
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
