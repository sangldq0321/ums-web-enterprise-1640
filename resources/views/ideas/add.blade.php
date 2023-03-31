@extends('layouts.main')
@section('title','Add idea')
@section('content')
<a href="/" type="button" class="btn btn-dark mb-3"><i class="fa-solid fa-chevron-left me-2"></i>Back</a>
<form action="/ideas/add" method="post" enctype="multipart/form-data">
    <h4 class="text-center fw-bold mb-3">Add idea</h4>
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
        <input type="text" class="form-control" placeholder="Idea name" name="ideaName">
        <label>Idea name</label>
    </div>
    <select class="form-select mb-3" name="categoryID">
        @foreach ($categories as $category)
        <option value="{{$category->categoryID}}">{{$category->categoryName}}</option>
        @endforeach
    </select>
    <div class="mb-3">
        <label for="formFile" class="form-label">Document</label>
        <input class="form-control" type="file" id="formFile" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
        text/plain, application/pdf" name="document">
    </div>
    <div class="mb-3">
        <label class="form-label">Idea content</label>
        <textarea class="form-control ckeditor" rows="3" name="ideaContent"></textarea>
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required
            oninvalid="this.setCustomValidity('You must agree to Terms and Conditions in order to submit idea !')"
            oninput="setCustomValidity('')">
        <label class="form-check-label" for="flexCheckDefault">I agree to <b>Terms and Conditions</b></label>
    </div>
    <button type="submit" class="btn btn-success d-block mx-auto">Save</button>
</form>
<script>
    ClassicEditor
        .create(document.querySelector('.ckeditor'), {
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    }
                ]
            }
        })
</script>
@endsection
