@extends('layouts.main')
@section('title', 'Add account')
@section('content')
    <h3 class="text-center">Add account</h3>
    <form action="/accounts/add" method="POST">
        @csrf
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
            <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username">
            <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="Fullname" name="fullname">
            <label for="floatingInput">Fullname</label>
        </div>
        <label class="mb-2">Role:</label>
        <select class="form-select mb-3" name="roleID">
            @foreach ($roles as $role)
                <option value="{{ $role->roleID }}">{{ $role->roleName }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-success d-block mx-auto">Save</button>
    </form>
@endsection
