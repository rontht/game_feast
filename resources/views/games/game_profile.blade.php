@extends('layouts.master')

@section('title')
GameFeast: {{$game->name}}
@endsection

@section('heading')
<a href="{{ url()->previous() }}" id="go-back-button"><i class="lni lni-arrow-left"></i></a>
<span>Game Info</span>
@endsection

@section('content')
<div class="container" id="game-container">
    <div class="row">
        <!-- Section 1 -->
        <div class="col pe-0">
            <div class="container" id="game-layout">

                <!-- Game Details Section -->
                <div class="row" id="game-detail-section">
                    <div class="col h-100" id="game-detail-col">
                        <div id="game-detail-box">
                            <p id="posted-by" class="m-1">Posted by {{$user->name}}</p>
                            <h1 id="game-name" class="m-1">{{$game->name}}</h1>
                            <a href="{{url("dev_profile/$dev->id")}}" class="m-1"
                                id="dev-link">by <u>{{$dev->name}}</u></a>
                            <p id="game-price" class="m-1">Price: AUD {{$game->price}}</p>
                            <p id="game-release-date" class="m-1">Release date: {{$game->release_date}}</p>
                            <p id="game-tag" class="m-1">Tags: {{$game->tag}}</p>
                            <div id="game-button-container">
                                <button id="edit-game-button" type="button" onclick="showForm(2)">
                                    <i class="lni lni-cogs pe-2"></i>update
                                </button>
                                <button id="delete-game-button" type="button"
                                    onclick='window.location="{{url("delete_game/$game->id")}}"'>
                                    <i class="lni lni-trash-can pe-2"></i>delete
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-7" id="game-detail-col">
                        <div id="about-box">
                            <h5 class="m-0"><u>Description</u></h5>
                            <p id="game-about">{{$game->about}}</p>
                        </div>
                    </div>
                </div>

                <!-- Game Average Rating Section -->
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
                </div>

                <!-- Reviews Section -->
                <div class="row" id="reviews-section">
                    <div id="reviews-container" class="mx-auto overflow-y-auto">
                        @if ($reviews)
                            <ul id="reviews-box" class="ms-1 p-0">
                                @foreach ($reviews as $review)
                                    <div class="card mb-3 container" style="width: 100%;">
                                        <div class="card-header row">
                                            <p class="col-1 m-0 p-0"><i class="lni lni-star-fill"></i> {{$review->rating}}</p>
                                            <p class="col ms-3 mb-0 p-0">{{$review->reviewer}}</p>
                                            <p class="col-3 text-end p-0 m-0">{{$review->posted_on}}</p>
                                            <div class="col-1 p-0" id="review-button-container">
                                                <a id="review-edit-button" href="{{url("game_profile/$game->id/$review->id")}}"
                                                    class="m-0"><i class="lni lni-cog"></i></a>
                                                <a id="review-delete-button"
                                                    href="{{url("delete_review/$game->id/$review->id")}}" class="m-0"><i
                                                        class="lni lni-cross-circle"></i></i></a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <span style="white-space: pre-line">{{$review->comment}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </ul>
                        @else
                            <div class="container h-100" id="no-review-box">
                                <div id="no-review" class="">
                                    <i class="lni lni-comments mx-1 fs-1"></i>
                                    <span class="fs-1">No review yet!</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2 -->
        <div class="col-4">
            <div class="container" id="game-layout" style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px;">
                <!-- Review Form Section-->
                <div class="row p-2" id="review-form-section"">
                @isset($review_to_edit)
                    @include('forms.review_edit_form')
                @else
                    @include('forms.review_form')
                @endisset
                </div>

                <!-- Other Section -->
                <div class=" row" id="other-section">
                    <div class="container">
                        <div class="row p-0" id="other-title" style="display: flex; justify-content: center; align-items: center;">
                            <span class="p-0 m-0 text-light" style="text-align: center;">
                                <i class="lni lni-arrow-down"></i>
                                Other games from this developer
                                <i class="lni lni-arrow-down"></i>
                            </span>
                        </div>
                        <!-- Show other games from the same developer -->
                        <div class="row" id="other-games-container">
                            @if ($other_games)
                                <div class="p-0 overflow-y-auto overflow-x-hidden" id="other-games-box">
                                    @foreach ($other_games as $other_game)
                                        <div style="width: 100%; height: 5rem;">
                                            <a href="{{url("game_profile/$other_game->id")}}">
                                            <div id="other-game-rows" class="p-2">
                                                <div style="width: 80%; display: flex; justify-content: center; align-items: center;">
                                                    <p class="fs-5 m-0">{{$other_game->name}}</p>
                                                </div>
                                                <div style="display: flex; flex-direction: column; width: 20%;">
                                                    <span><i class="lni lni-star-fill"></i>{{$other_game->rating}}</span>
                                                    <span><i class="lni lni-coin"></i>{{$other_game->price}}</span>
                                                </div>
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