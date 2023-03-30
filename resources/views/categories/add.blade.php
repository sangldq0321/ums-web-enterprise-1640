@extends('layouts.main')
@section('title','Add category')
@section('content')
<a href="/categories" type="button" class="btn btn-dark mb-3"><i class="fa-solid fa-chevron-left me-2"></i>Back</a>
<form action="/categories/add" method="POST">
    <h4 class="text-center fw-bold mb-3">Add category</h4>
    @csrf
    <div class="form-floating mb-3">
        <input type="text" class="form-control" placeholder="Category name" name="categoryName">
        <label>Category name</label>
    </div>
    <div class="mb-3">
        <label class="form-label">Category desciption</label>
        <textarea class="form-control ckeditor" rows="3" name="categoryDesc"></textarea>
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
