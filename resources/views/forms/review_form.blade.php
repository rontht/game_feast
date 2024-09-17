<p class=" text-center fs-5">Write a review.</p>
<form method="post" action="{{url("add_review_action")}}">
    {{csrf_field()}}
    <input type="hidden" name="review_game_id" value="{{$game->id}}"></input>
    <div class="p-1 mb-2" id="add-input-container">
        <div class="row g-3 align-items-center">
            <!-- username -->
            @if (Session::get('name'))
                <label>Hello, {{Session::get('name')}}.</label>
                <input class="form-control-plaintext" id="add-input" type="text" name="review_username"
                    value="{{Session::get('name')}}" hidden>
            @else
                <div class="col-3">
                    <label for="review-input" class="col-form-label">Username</label>
                </div>
                <div class="col">
                    <input type="text" id="review-input" name="review_username" class="form-control">
                </div>
            @endif
        </div>
    </div>

    <div class="container mb-2">
        <div class="row">
            <div class="col-2 p-0">
                <!-- Rating -->
                <div class="input-group">
                    <span class="input-group-text-plaintext" id="review-icon">
                        <i class="lni lni-star-fill"></i></span>
                    <input type="text" class="form-control-plaintext p-0" readonly id="rating-display" value="5"
                        aria-label="5" name="review_rating">
                </div>
            </div>
            <div class="col p-0">
                <!-- Rating Range -->
                <input class="form-range p-0 mb-1" id="rating-range" type="range" name="review_rating" min="1" max="10"
                value="5" onchange="updateRating(this.value);" style="color: red;">
            </div>
        </div>
    </div>
    <!-- Comment -->
    <div class="mb-2">
        <label for="comment-textarea" class="form-label">Comment</label>
        <textarea class="form-control" id="comment-textarea" rows="4" name="review_comment"></textarea>
    </div>
    <!-- Button -->
    <div id="review-button" style="display: flex; align-items: center; justify-content: center;">
        <input id="add-button" type="submit" value="Submit">
    </div>
</form>