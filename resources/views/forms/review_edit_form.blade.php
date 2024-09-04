<p class=" text-center fs-5">Editing a review.</p>
<form method="post" action="{{url("edit_review_action")}}">
    {{csrf_field()}}
    <!-- Other necessary fields -->
    <input type="hidden" name="id" value="{{$review_to_edit->id}}"></input>
    <input type="hidden" name="game_id" value="{{$review_to_edit->game_id}}"></input>
    <input type="hidden" name="posted_on" value="{{$review_to_edit->posted_on}}"></input> <!-- original posted date will not change-->
    <input type="hidden" name="user_id" value="{{$review_to_edit->user_id}}"></input>
    <div class="p-1 mb-2" id="add-input-container">
        <div class="row g-3 align-items-center">
            <!-- username -->
            <!-- @if (Session::get('name'))
                <label>Hello, {{Session::get('name')}}.</label>
                <input class="form-control-plaintext" id="add-input" type="text" name="username"
                    value="{{Session::get('name')}}" hidden>
            @else
                <div class="col-3">
                    <label for="review-input" class="col-form-label">Username</label>
                </div>
                <div class="col">
                    <input type="text" id="review-input" name="name" class="form-control">
                    <div id="validation-feedback" class="invalid-feedback">Please write your comment!</div>
                    <div id="validation-feedback" class="valid-feedback">Perfect!</div>
                </div>
            @endif -->
        </div>
    </div>

    <div class="container mb-2">
        <div class="row">
            <div class="col-2 p-0">
                <!-- Rating -->
                <div class="input-group">
                    <span class="input-group-text-plaintext" id="review-icon">
                        <i class="lni lni-star-fill"></i></span>
                    <input type="text" class="form-control-plaintext p-0" readonly id="rating-display" value="{{$review_to_edit->rating}}"
                        aria-label="5" name="rating">
                </div>
            </div>
            <div class="col p-0">
                <!-- Rating Range -->
                <input class="form-range p-0 mb-1" id="rating-range" type="range" name="rating" min="0" max="10"
                    value="{{$review_to_edit->rating}}" onchange="updateRating(this.value);" style="color: red;">
            </div>
        </div>
    </div>
    <!-- Comment -->
    <div class="mb-2">
        <label for="comment-textarea" class="form-label">Comment</label>
        <textarea class="form-control" id="comment-textarea" rows="4" name="comment">{{$review_to_edit->comment}}</textarea>
    </div>
    <!-- Button -->
    <div id="review-button">
        <input class="btn btn-primary" type="submit" value="Submit">
    </div>
</form>