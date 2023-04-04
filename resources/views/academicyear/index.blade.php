@extends('layouts.main')
@section('title', 'Academic year')
@section('content')
<h3 class="text-center">Academic year</h3>
<table class="table table-hover w-100" id="datatable">
    <thead class="table-dark">
        <tr>
            <th scope="col">Open date</th>
            <th scope="col">Close date</th>
            <th scope="col">Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($acayears as $acayear)
        <tr>
            <td>{{$acayear->open_date}}</td>
            <td>{{$acayear->close_date}}</td>
            <td><a href="/ideas/acayear/edit/{{$acayear->academicYearID}}" class="btn btn-warning"><i
                        class="fa-solid fa-pen-to-square me-2"></i>Edit</a></td>
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
