@extends('layouts.main')
@section('title','Category')
@section('content')
<h3 class="text-center">Ideas</h3>
@if (Auth::check() && Auth::user()->roleID !=3)
<div class="d-flex justify-content-center mb-3">
    <a href="/ideas/add" class="btn btn-success"><i class="fa-solid fa-plus me-2"></i>Add</a>
</div>
@endif
<table class="table" id="datatable">
    <thead class="table-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Ideas category</th>
            <th scope="col">Ideas name</th>
            <th scope="col">Uploader</th>
            @if (Auth::check() && Auth::user()->roleID !=3)
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($ideas as $idea)
        <tr>
            <th scope="row">{{$idea->ideaID}}</th>
            <td>{{$categoryName}}</td>
            <td>{{$idea->ideaName}}</td>
            <td>Anonymous</td>
            @if (Auth::check() && Auth::user()->roleID !=3)
            <td><a href="/ideas/edit/{{$idea->ideaID}}"><i class="fa-solid fa-pen-to-square me-2"></i>Edit</a></td>
            <td>
                <form method="POST" action="/ideas/delete/{{ $idea->ideaID }}">
                    @csrf
                    <input name="_method" type="hidden" value="GET">
                    <a type="button" class="show_delete" data-toggle="tooltip"><i
                            class="fa-solid fa-trash me-2"></i>Delete</a>
                </form>
            </td>
            @endif
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
            text: 'Are you sure to delete this idea ?',
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
