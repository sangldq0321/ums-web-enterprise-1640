@extends('layouts.main')
@section('title', 'Add idea')
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
    <label class="mb-2">Category name:</label>
    <select class="form-select mb-3" name="categoryID">
        @foreach ($categories as $category)
        <option value="{{ $category->categoryID }}">{{ $category->categoryName }}</option>
        @endforeach
    </select>
    <div class="mb-3">
        <label for="formFile" class="form-label">Document:</label>
        <input class="form-control" type="file" id="formFile" accept=".docx, .xlsx, .pdf, .txt, .pptx" name="document">
    </div>
    <div class="mb-3">
        <label class="form-label">Idea content:</label>
        <textarea class="form-control ckeditor" rows="3" name="ideaContent"></textarea>
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required
            oninvalid="this.setCustomValidity('You must agree to Terms and Conditions in order to submit idea !')"
            oninput="setCustomValidity('')">
        <p>I agree to <b><a href="" data-bs-toggle="modal" data-bs-target="#termModal">Terms and
                    Conditions</a></b></p>
    </div>
    <div class="modal fade" id="termModal" tabindex="-1" aria-labelledby="termModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Terms and
                        Conditions</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Please read these Terms and Conditions carefully before using the Service.</p>
                    <p>Your access to and use of the Service is conditioned on your acceptance of and compliance
                        with
                        these Terms.These Terms apply to all visitors, users and others who access or use the
                        Service.</p>
                    <p>By accessing or using the Service you agree to be bound by these Terms. If you disagree
                        with any
                        part of the terms then you may not access the Service.</p>
                    <p class="h5 fw-bold">Content</p>
                    <p>Our Service allows you to post, link, store, share and otherwise make available certain
                        information, text, graphics, or other material ("Content"). You are responsible for the Content
                        that you post to the Service, including its legality, reliability, and appropriateness.</p>
                    <p>By posting Content to the Service, you grant us the right and license to publicly display,
                        reproduce, and distribute such Content on and through the Service. You retain any and all of
                        your rights to any Content you submit, post or display on or through the Service and you are
                        responsible for protecting those rights. You agree that this license includes the right for us
                        to make your Content available to other users of the Service, who may also use your Content
                        subject to these Terms.</p>
                    <p class="h5 fw-bold">Accounts</p>
                    <p>When you create an account with us, you must provide us information that is accurate, complete,
                        and current at all times. Failure to do so constitutes a breach of the Terms, which may result
                        in immediate termination of your account on our Service.</p>
                    <p>You are responsible for safeguarding the password that you use to access the Service and for any
                        activities or actions under your password, whether your password is with our Service or a
                        third-party service</p>
                    <p>You agree not to disclose your password to any third party. You must notify us immediately upon
                        becoming aware of any breach of security or unauthorized use of your account.</p>
                    <p>You may not use as a username the name of another person or entity or that is not lawfully
                        available for use, a name or trade mark that is subject to any rights of another person or
                        entity other than you without appropriate authorization, or a name that is otherwise offensive,
                        vulgar or obscene.</p>
                    <p class="h5 fw-bold">Termination</p>
                    <p>We may terminate or suspend your account immediately, without prior notice or liability, for any
                        reason whatsoever, including without limitation if you breach the Terms.</p>
                    <p>Upon termination, your right to use the Service will immediately cease. If you wish to terminate
                        your account, you may simply discontinue using the Service.</p>
                    <p class="h5 fw-bold">Disclaimer</p>
                    <p>Your use of the Service is at your sole risk. The Service is provided on an "AS IS" and "AS
                        AVAILABLE" basis. The Service is provided without warranties of any kind, whether express or
                        implied, including, but not limited to, implied warranties of merchantability, fitness for a
                        particular purpose, non-infringement or course of performance.</p>
                    <p class="h5 fw-bold">Governing Law</p>
                    <p>These Terms shall be governed and construed in accordance with the laws of Belgium, without
                        regard to its conflict of law provisions.
                        Our failure to enforce any right or provision of these Terms will not be considered a waiver of
                        those rights. If any provision of these Terms is held to be invalid or unenforceable by a court,
                        the remaining provisions of these Terms will remain in effect. These Terms constitute the entire
                        agreement between us regarding our Service, and supersede and replace any prior agreements we
                        might have between us regarding the Service.</p>
                    <p class="h5 fw-bold">Changes</p>
                    <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a
                        revision is material we will try to provide at least 15 days notice prior to any new terms
                        taking effect. What constitutes a material change will be determined at our sole discretion.</p>
                    <p>By continuing to access or use our Service after those revisions become effective, you agree to
                        be bound by the revised terms. If you do not agree to the new terms, please stop using the
                        Service.</p>
                    <p class="h5 fw-bold">Contact Us</p>
                    <p>If you have any questions about these Terms, please contact us.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
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
