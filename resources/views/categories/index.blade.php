@extends('layouts.main')
@section('title','Category')
@section('content')
<h3 class="text-center">Categories</h3>
<div class="d-flex justify-content-center mb-3">
    <a href="/categories/add" class="btn btn-success"><i class="fa-solid fa-plus me-2"></i>Add</a>
</div>
<table class="table" id="datatable">
    <thead class="table-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Category name</th>
            <th scope="col">Category description</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <th scope="row">{{$category->categoryID}}</th>
            <td>{{$category->categoryName}}</td>
            <td>{!!$category->categoryDesc!!}</td>
            <td><a href="/categories/edit/{{$category->categoryID}}"><i
                        class="fa-solid fa-pen-to-square me-2"></i>Edit</a></td>
            <td>
                <form method="POST" action="/categories/delete/{{ $category->categoryID }}">
                    @csrf
                    <input name="_method" type="hidden" value="GET">
                    <a type="button" class="show_delete" data-toggle="tooltip"><i
                            class="fa-solid fa-trash me-2"></i>Delete</a>
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
            text: 'Are you sure to delete this category ?',
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
