@extends('layouts.master')

@section('title')
GameFeast: {{$game->name}}
@endsection

@section('heading')
{{$game->name}}
@endsection

@section('content')

<div class="container" id="game-container">
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

        <!-- Review Form -->
        <div class="col p-2" id="review-form">
            <p>Write a review.</p>
            <form method="post" action="{{url("add_review_action")}}">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$game->id}}"></input>
                <div class="container mb-2">
                    <div class="row">
                        <!-- Username -->
                        <div class="col p-0">
                            <div class="input-group col-3">
                                <span class="input-group-text-plaintext" id="review-icon">
                                    <i class="lni lni-user"></i></span>
                                <input type="text" class="form-control-plaintext p-0" id="username-input"
                                    placeholder="username" name="name">
                            </div>
                        </div>
                        <div class="col-2 p-0">
                            <!-- Rating -->
                            <div class="input-group">
                                <span class="input-group-text-plaintext" id="review-icon">
                                    <i class="lni lni-star-fill"></i></span>
                                <input type="text" class="form-control-plaintext p-0" readonly id="rating-display"
                                    value="5" aria-label="5" name="rating">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Rating Range -->
                <input class="form-range p-0 mb-1" id="rating-range" type="range" name="rating" min="0" max="10"
                    value="5" onchange="updateRating(this.value);">
                <!-- Comment -->
                <div class="mb-2">
                    <label for="comment-textarea" class="form-label">Write your comment below . . .</label>
                    <textarea class="form-control" id="comment-textarea" rows="5" name="comment"></textarea>
                </div>
                <!-- Button -->
                <div id="review-button">
                    <input class="btn btn-primary" type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>

    <!-- For reviews -->
    <div class="row" id="reviews-section">
        @if ($reviews)
        <ul id="reviews-container" class="mt-3">
            @foreach ($reviews as $review)
                <div class="card mb-3" style="width: 100%;">
                    <div class="card-header">
                        <span><i class="lni lni-star-fill"></i> {{$review->rating}}</span>
                        <span>{{$review->reviewer}}</span>
                        <span>{{$review->posted_on}}</span>
                    </div>
                    <div class="card-body">
                        <span>{{$review->comment}}</span>
                    </div>
                </div>
            @endforeach
        </ul>
        @else
            <p id="testing">No Review found.</p>
        @endif
    </div>
</div>
@endsection