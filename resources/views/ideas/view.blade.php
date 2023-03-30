@extends('layouts.main')
@section('title','View idea')
@section('content')
<h1 class="fw-bold">{{$idea->ideaName}}</h1>
<div>Category: <b>{{$categoryName}}</b></div>
<div class="mb-3">Upload by: <b>{{$fullname}}</b> at
    <?php
    $date=date_create($idea->created_at);
    echo date_format($date,"d/m/Y H:i:s A");
    ?>
</div>
{!!$idea->ideaContent!!}
<hr>
<form>
    <div class="my-3">
        <h2>Comment</h2>
        <textarea class="form-control ckeditor" rows="3" name="ideaContent"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Comment</button>
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
