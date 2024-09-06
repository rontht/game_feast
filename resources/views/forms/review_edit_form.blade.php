<p class=" text-center fs-5">Editing a review.</p>
<form method="post" action="{{url("edit_review_action")}}">
    {{csrf_field()}}
    <!-- Other necessary fields -->
    <input type="hidden" name="review_id_edit" value="{{$review_to_edit->id}}"></input>
    <input type="hidden" name="review_game_id_edit" value="{{$review_to_edit->game_id}}"></input>
    <input type="hidden" name="review_posted_on_edit" value="{{$review_to_edit->posted_on}}"></input> <!-- original posted date will not change-->
    <input type="hidden" name="review_user_id_edit" value="{{$review_to_edit->user_id}}"></input>
    <div class="container mb-2">
        <div class="row">
            <div class="col-2 p-0">
                <!-- Rating -->
                <div class="input-group">
                    <span class="input-group-text-plaintext" id="review-icon">
                        <i class="lni lni-star-fill"></i></span>
                    <input type="text" class="form-control-plaintext p-0" readonly id="rating-display" value="{{$review_to_edit->rating}}"
                        aria-label="5" name="review_rating_edit">
                </div>
            </div>
            <div class="col p-0">
                <!-- Rating Range -->
                <input class="form-range p-0 mb-1" id="rating-range" type="range" name="review_rating_edit" min="0" max="10"
                    value="{{$review_to_edit->rating}}" onchange="updateRating(this.value);" style="color: red;">
            </div>
        </div>
    </div>
    <!-- Comment -->
    <div class="mb-2">
        <label for="comment-textarea" class="form-label">Comment</label>
        <textarea class="form-control" id="comment-textarea" rows="4" name="review_comment_edit">{{$review_to_edit->comment}}</textarea>
    </div>
    <!-- Button -->
    <div id="review-button" style="display: flex; align-items: center; justify-content: center;">
        <input id="add-button" type="submit" value="Submit">
    </div>
</form>