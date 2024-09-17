@extends('layouts.master')

@section('title')
GameFeast: Browse Developers
@endsection

@section('heading')
Browse Developers
@endsection

@section('content')
<a href="{{url("dev_profile/$unknown->id")}}">
<div class="container mt-1" id="devs-intro-container">
        <strong>Unknown Dev</strong>: games without proper developer assigned to them will go into unknown developer
        category. Click here to view them!
    </div>
</a>
<div class="container" id="devs-list-container">
    <div class="container p-0" id="devs-list">
        @if ($devs)
            <ul class="p-0">
                @foreach ($devs as $dev)
                    <li>
                        <a id="dev-list-item" href="{{url("dev_profile/$dev->id")}}">
                            <div class="row" style="height: 15vh;">
                                <div class="col-3" id="dev-box">
                                    <div id="dev-logo">
                                        <span>{{$dev->first_char}}</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row" id="dev-info">
                                        <strong>{{$dev->name}}</strong>
                                    </div>
                                    <div class="row" id="dev-info-1">
                                        <span><i class="lni lni-star-fill"></i>{{$dev->rating}}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="container h-100" id="no-review-box">
                <div id="no-review" class="">
                    <i class="lni lni-comments mx-1 fs-1"></i>
                    <span class="fs-1">Sorry, no developers in our database.</span>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('forms')
<div id="form_1" class="custom_form overflow-hidden">
    @include('forms.add_form')
</div>
@endsection