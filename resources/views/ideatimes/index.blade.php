@extends('layouts.main')
@section('title', 'Idea Time Submit')
@section('content')
<div class="mt-3">
    <h3 class="text-center">Academic Year</h3>
    <div class="d-flex justify-content-center mb-3">
        <a href="/idea/academicyear/add" class="btn btn-primary">ADD</a>
    </div>
    <table>
        <tr>
            <th>Semester</th>
            <th>Open Date</th>
            <th>Close Date</th>
            <th>Config</th>
        </tr>
        @foreach ($acayear as $item)
            <tr>
                <td>{{$item->semester}}</td>
                <td>{{$item->openDate}}</td>
                <td>{{$item->closeDate}}</td>
                <td>
                    <div class=" row row-cols-2">
                        <div class="col d-flex justify-content-center">
                            <a href="/idea/academicyear/edit/{{$item->semester}}"><i class="fa-solid fa-wrench" style="color: #005eff;"></i></a>
                        </div>
                        <div class="col d-flex justify-content-center">
                            <a href="/idea/academicyear/delete/{{$item->semester}}"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@if (session('notify') == 'addSucess')
    <script>
        Swal.fire({
            title: 'Add New Academic Year Successfull',
            icon: 'success',
            timer: '2000',
            allowConfirmButton: false,
            allowOutsideClick: false,
        })
    </script>

@endif
@endsection
