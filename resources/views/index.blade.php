@extends('layouts.main')
@if (Auth::user()->roleID===1)
@section('title','Dashboard')
@elseif (Auth::user()->roleID!==1)
@section('title','Home')
@endif
@section('content')
@if(Auth::user()->roleID==1)
<h3 class="text-center fw-bold">Dashboard</h3>
@else
@if (Auth::check() && Auth::user()->roleID ==4 || Auth::user()->roleID ==5)
<div class="d-flex justify-content-center mb-3">
    <a href="/ideas/add" class="btn btn-success"><i class="fa-solid fa-plus me-2"></i>Add</a>
</div>
@endif
<div class="row">
    <div class="col-12 col-lg-9">
        @if(Auth::user()->roleID!==1)
        @foreach ($ideas as $idea)
        <div class="card mb-3">
            {{-- <img src="..." class="card-img-top" alt="..."> --}}
            <div class="card-body">
                <h3 class="card-title fw-bold">{{$idea->ideaName}}</h3>
                <div class="card-text">
                    <div>Category: <b>{{$categoryName}}</b></div>
                    <div>Upload by: <b>Anonymous</b> at
                        <?php $date=date_create($idea->created_at);
            echo date_format($date,"h:i A d/m/Y");
            ?>
                    </div>
                    </p>
                    @if (Auth::check() && Auth::user()->roleID ==4 || Auth::user()->roleID ==5)
                    <td><a href="/ideas/edit/{{$idea->ideaID}}" class="m-2"><i
                                class="fa-solid fa-pen-to-square me-2"></i>Edit</a>
                    </td>
                    <td>
                        <form method="POST" action="/ideas/delete/{{ $idea->ideaID }}" class="d-inline-block">
                            @csrf
                            <input name="_method" type="hidden" value="GET">
                            <a type="button" class="show_delete m-2" data-toggle="tooltip"><i
                                    class="fa-solid fa-trash me-2"></i>Delete</a>
                        </form>
                    </td>
                    @endif
                    <div>
                        <a href="/ideas/view/{{$idea->ideaID}}" class="btn btn-primary m-2">View more<i
                                class="fa-solid fa-angle-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="d-flex justify-content-center mt-3">
            {{ $ideas->links() }}
        </div>
        @endif
    </div>
    <div class="col-12 col-lg-3 mt-3 mt-lg-0">
        <div class="card w-100 mb-3">
            <div class="card-body">
                <h5 class="card-title fw-bold">User</h5>
                <p class="card-text">
                    @foreach ($users->where('roleID',Auth::user()->roleID) as $user)
                    @if($user->fullname==Auth::user()->fullname)
                <div><b>{{$user->fullname}} (You)</b></div>
                @else
                <div>{{$user->fullname}}</div>
                @endif
                @endforeach
                </p>
            </div>
        </div>
        <div class="card w-100 mb-3">
            <div class="card-body">
                <h5 class="card-title fw-bold">Most popular idea</h5>
                <p class="card-text">Placeholder</p>
            </div>
        </div>
        <div class="card w-100 mb-3">
            <div class="card-body">
                <h5 class="card-title fw-bold">Most viewed idea</h5>
                <p class="card-text">
                <div class="fw-bold h5"><a href="/ideas/view/{{$mostViewIdea->ideaID}}">{{$mostViewIdea->ideaName}}</a>
                </div>
                <div>
                    <?php
                    $date=date_create($latestIdea->created_at);
                    echo date_format($date,"h:i A d/m/Y");
                    ?>
                </div>
                </p>
            </div>
        </div>
        <div class="card w-100 mb-3">
            <div class="card-body">
                <h5 class="card-title fw-bold">Latest idea</h5>
                <p class="card-text">
                <div class="fw-bold h5"><a href="/ideas/view/{{$latestIdea->ideaID}}">{{$latestIdea->ideaName}}</a>
                </div>
                <div>
                    <?php
                    $date=date_create($latestIdea->created_at);
                    echo date_format($date,"h:i A d/m/Y");
                    ?>
                </div>
                </p>
            </div>
        </div>
        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title fw-bold">Latest comment</h5>
                <p class="card-text">
                    @if ($countComment==0)
                <div>There is no comment yet !</div>
                @else
                <div class="h6 mb-0 fw-bold">Anonymous:</div>
                <div>{{$latestComment->commentContent}}</div>
                <div>
                    <?php
                    $date=date_create($latestComment->created_at);
                    echo date_format($date,"h:i A d/m/Y");
                    ?>
                </div>
                @endif
                </p>
            </div>
        </div>
    </div>
</div>
@endif
<script script type="text/javascript">
    $('.show_delete').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure ?',
            text: 'Are you sure to delete this idea ?',
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
