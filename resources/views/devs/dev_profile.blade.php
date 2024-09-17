@extends('layouts.master')

@section('title')
GameFeast: {{$dev->name}}
@endsection

@section('heading')
<a href="{{ url()->previous() }}" id="go-back-button"><i class="lni lni-arrow-left"></i></a>
<span>Developer Info</span>
@endsection

@section('content')
<div class="container" id="dev-layout">

    <!-- Game Details -->
    <div class="row" id="dev-detail-section">
        <div class="col h-100" id="dev-detail-col">
            <div id="dev-detail-box">
                @if ($dev->id != 1)
                    <div id="logo-container">
                        <div id="dev-profile-logo">
                            <span>{{$dev->first_char}}</span>
                        </div>
                    </div>
                    <h1 id="dev-name" class="m-1">{{$dev->name}}</h1>
                    <div id="dev-button-container">
                        <button id="edit-dev-button" onclick="showForm(3)" type="button"><i
                                class="lni lni-cogs"></i>UPDATE</button>
                        <button id="delete-dev-button" type="button"
                            onclick='window.location="{{url("delete_dev/$dev->id")}}"'>
                            <i class="lni lni-trash-can pe-2"></i>DELETE
                        </button>
                    </div>
                @else
                    <h1 id="dev-name" class="m-1">{{$dev->name}}</h1>
                @endif
            </div>
        </div>
        <div class="col-7" id="dev-detail-col">
            <div id="about-box">
                <h5 class="m-0"><u>Description</u></h5>
                <p id="dev-about">{{$dev->about}}</p>
            </div>
        </div>
    </div>

    <!-- Game Average Rating -->
    <div class="row" id="average-section">
        @if ($games)
            <p class="fs-1 text-center p-0 text-light">
                <i class="lni lni-star-fill"></i>{{$avg_rating}}
            </p>
        @else
            <p class="fs-5 text-center p-0 mt-2 text-light">
                Sorry, not enough reviews to produce overall rating.
            </p>
        @endif
    </div>

    <!-- For reviews -->
    <div class="row" id="games-section">
        <div id="games-container" class="mx-auto overflow-y-auto">
            @if ($games)
                <ul id="games-box" class="m-0 p-0">
                    @foreach ($games as $game)
                        <div class="container p-0" id="dev-games-container">
                            <a href="{{url("game_profile/$game->id")}}" id="dev-games-link">
                                <div class="row p-0 m-0" style="height: 10vh;">
                                    <div class="col-2 p-0">
                                        <div id="game-rating-box">
                                            <i class="lni lni-star-fill"></i>
                                            <span>{{$game->rating}}</span>
                                        </div>
                                    </div>
                                    <div class="col p-0">
                                        <div id="game-name-box">
                                            <p class="m-0" id="games-name">{{$game->name}}</p>
                                            <p class="m-0">Tags: {{$game->tag}}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </ul>
            @else
                <div class="container h-100" id="no-game-box">
                    <div id="no-game">
                        <i class="lni lni-game mx-1 fs-1"></i>
                        <span class="fs-1">No game found!</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('forms')
<div id="form_1" class="custom_form overflow-hidden">
    @include('forms.add_form')
</div>
<div id="form_3" class="custom_form overflow-hidden">
    @include('forms.edit_dev_form')
</div>
@endsection