@extends('layouts.master')

@section('title')
GameFeast: {{$game->name}}
@endsection

@section('heading')
Game Info
@endsection

@section('content')
<div class="container" id="game-container">
    <div class="row">
        <!-- Section 1 -->
        <div class="col pe-0">
            <div class="container" id="game-layout">

                <!-- Game Details -->
                <div class="row" id="game-detail-section">
                    <!-- Image -->
                    <div class="col" id="game-image-box">
                        <div id="image-holder">
                            <div id="image-placeholder">This is a placeholder for images.</div>
                        </div>
                    </div>
                    <!-- Details -->
                    <div class="col" id="game-detail-box">
                        <div id="name-box">
                            <p>Posted by {{$user->name}}</p>
                            <h1>{{$game->name}}</h1>
                            <p>{{$game->price}}</p>
                        </div>
                        <div id="dev-box">
                            <a href="{{url("dev_profile/$dev->id")}}"><u>{{$dev->name}}</u></a>
                            <p>{{$game->release_date}}</p>
                        </div>
                        <div id="tag-box">
                            <p>Tags: {{$game->tag}}</p>
                        </div>
                        <div id="about-box">
                            <p>{{$game->about}}</p>
                        </div>
                    </div>
                </div>

                <!-- Game Average Rating -->
                <div class="row" id="average-section">
                    @if ($reviews)
                        <p class="fs-1 text-center p-0 text-light">
                            <i class="lni lni-star-fill"></i>{{$avg_rating}}
                        </p>
                    @else
                        <p class="fs-5 text-center p-0 mt-2 text-light">
                            Sorry, not enough reviews to produce overall rating.
                        </p>
                    @endif
                    <button id="add-menu-button" type="button" onclick="showForm(2)"><i class="lni lni-cog"></i>EDIT</button>
                    <!-- <a href="{{url("edit_game/$game->id")}}"><i class="lni lni-cog"></i>EDIT</a> -->
                    <a href="{{url("delete_game/$game->id")}}"><i class="lni lni-trash-can"></i>DELETE</a>
                </div>

                <!-- For reviews -->
                <div class="row" id="reviews-section">
                    <div id="reviews-container" class="mx-auto overflow-y-auto">
                        @if ($reviews)
                            <ul id="reviews-box" class="ms-1 p-0">
                                @foreach ($reviews as $review)
                                    <div class="card mb-3 container" style="width: 100%;">
                                        <div class="card-header row">
                                            <p class="col-2 m-0"><i class="lni lni-star-fill"></i> {{$review->rating}}</p>
                                            <p class="col m-0">{{$review->reviewer}}</p>
                                            <a href="{{url("game_profile/$game->id/$review->id")}}" class="col m-0">Edit</a>
                                            <p class="col-4 text-end m-0">{{$review->posted_on}}</p>
                                        </div>
                                        <div class="card-body">
                                            <span>{{$review->comment}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </ul>
                        @else
                            <div class="container h-100" id="no-review-box">
                                <div id="no-review" class="">
                                    <i class="lni lni-comments mx-1 fs-1"></i>
                                    <span class="fs-1">No Review found.</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2 -->
        <div class="col-4">
            <div class="container" id="game-layout">
                <!-- Review Form -->
                <div class="row p-2" id="review-form-section"">
                @isset($review_to_edit)
                    @include('forms.review_edit_form')
                @else
                    @include('forms.review_form')
                @endisset
                </div>
                <div class=" row" id="other-section">
                    <div class="container">
                        <div class="row" id="other-title">
                            <p class="text-center fs-5 p-0 mt-2 text-light">
                                <i class="lni lni-arrow-down"></i>
                                Other games from this developer
                                <i class="lni lni-arrow-down"></i>
                            </p>
                        </div>
                        <div class="row" id="other-games-container">
                            @if ($other_games)
                                <div class="mx-auto p-0 overflow-y-auto" id="other-games-box">
                                    @foreach ($other_games as $other_game)
                                        <div class="card m-auto" style="width: 23rem; height: 5rem;">
                                            <a href="{{url("game_profile/$other_game->id")}}">
                                                <div class="card-header">
                                                    <h5 class="card-title">{{$other_game->name}}</h5>
                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text"><i
                                                            class="lni lni-star-fill"></i>{{$other_game->rating}}</p>
                                                    <p class="card-text"><i class="lni lni-coin"></i>AUD {{$other_game->price}}
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('forms')
<div id="form_1" class="custom_form overflow-hidden">
    @include('forms.add_form')
</div>
<div id="form_2" class="custom_form overflow-hidden">
    @include('forms.edit_game_form')
</div>
@endsection