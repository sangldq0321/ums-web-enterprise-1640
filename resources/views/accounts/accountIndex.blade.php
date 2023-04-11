@extends('layouts.main')
@section('title','Manage account')
@section('content')<h3 class="text-center">Accounts</h3>
<table class="table table-hover w-100" id="datatable">
    <thead class="table-dark">
        <th scope="col">Username</th>
        <th scope="col">Fullname</th>
        <th scope="col">Role</th>
    </thead>
    <tbody>
        @foreach ($users as $user)
        @if($user->roleID!==1)
        <tr>
            <td>{{$user->username}}</td>
            <td>{{$user->fullname}}</td>
            <td>{{$user->roleName}}</td>
        </tr>
        @else
        @endif
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
    $('.show_reset').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure ?',
            text: 'Are you sure to reset password ?',
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
