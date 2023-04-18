@extends('layouts.main')
@section('title', 'Manage account')
@section('content')
    <div class="d-flex justify-content-center mb-3">
        <a href="/accounts/add" class="btn btn-success"><i class="fa-solid fa-plus me-2"></i>Add</a>
    </div>
    <h3 class="text-center">Accounts</h3>
    <table class="table table-hover w-100" id="datatable">
        <thead class="table-dark">
            <th scope="col">Username</th>
            <th scope="col">Fullname</th>
            <th scope="col">Role</th>
            <th scope="col">Reset password</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
                @if ($user->roleID != 1)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->fullname }}</td>
                        <td>{{ $user->roleName }}</td>
                        <td>
                            <form method="POST" action="/accounts/reset/{{ $user->userID }}">
                                @csrf
                                <input name="_method" type="hidden" value="GET">
                                <a type="button" class="show_reset btn btn-danger" data-toggle="tooltip"><i
                                        class="fa-solid fa-arrows-rotate me-2"></i>Reset</a>
                            </form>
                        </td>
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
