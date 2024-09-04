<?php

use Illuminate\Support\Facades\Route;
use Mockery\Undefined;

// ___________________________________________________________________________________________________________________________ Routes


Route::get('/', function () {
    $sql = "select * from game";
    $games = DB::select($sql);
    $devs = get_all_dev();
    return view('home')->with('games', $games)->with('devs', $devs);
});

Route::get('game', function () {
    $sql = "select * from game";
    $games = DB::select($sql);
    $devs = get_all_dev();
    return view('games.game')->with('games', $games)->with('devs', $devs);
});

Route::get('game_profile/{id}', function ($id) {
    $game = get_game($id);
    $user = get_user($game->user_id);
    $dev = get_dev($game->dev_id);
    $reviews = get_reviews($id);
    $devs = get_all_dev();
    $avg_rating = get_game_rating($reviews);
    $other_games = get_other_games($game->id, $game->dev_id);

    // get dev_info for game edit
    $dev_info = get_dev($game->dev_id);

    return view('games.game_profile')->with('game', $game)->with('user', $user)->with('dev', $dev)->with('reviews', $reviews)->with('devs', $devs)->with('avg_rating', $avg_rating)->with('other_games', $other_games)->with('dev_info', $dev_info);
});

Route::get('game_profile/{game_id}/{review_id}', function ($game_id, $review_id) {
    $game = get_game($game_id);
    $user = get_user($game->user_id);
    $dev = get_dev($game->dev_id);
    $reviews = get_reviews($game_id);
    $devs = get_all_dev();
    $avg_rating = get_game_rating($reviews);
    $other_games = get_other_games($game->id, $game->dev_id);

    //for editing review
    $review_to_edit = get_review($review_id);

    // get dev_info for game edit
    $dev_info = get_dev($game->dev_id);
    return view('games.game_profile')->with('game', $game)->with('user', $user)->with('dev', $dev)->with('reviews', $reviews)->with('devs', $devs)->with('avg_rating', $avg_rating)->with('other_games', $other_games)->with('review_to_edit', $review_to_edit)->with('dev_info', $dev_info);
});

Route::get('dev', function () {
    $sql = "select * from dev";
    $devs = DB::select($sql);
    return view('devs.dev')->with('devs', $devs);
});

Route::get('dev_profile/{id}', function ($id) {
    $sql = "select * from game where dev_id=?";
    $games = DB::select($sql, array($id));
    $dev = get_dev($id);
    $devs = get_all_dev();
    $avg_rating = get_dev_rating($id);
    return view('devs.dev_profile')->with('dev', $dev)->with('games', $games)->with('devs', $devs)->with('avg_rating', $avg_rating);
});


// ___________________________________________________________________________________________________________________________ Actions


Route::post('add_dev_action', function () {
    // validate name
    $name = request('name');
    $name = validate_required($name);
    $name = validate_name($name);

    // no validation required
    $about = request('about');
    
    // add to database
    $id = add_dev($name, $about);
    if ($id) {
        return redirect("dev_profile/$id");
    } else {
        die("Error while adding game.");
    }
});

Route::post('add_game_action', function () {
    // validate name
    $name = request('name');
    $name = validate_required($name);
    $name = validate_name($name);

    // validate required fields
    $release_date = request('release_date');
    $release_date = validate_required($release_date);
    $tag = request('tag');
    $tag = validate_required($tag);
    
    // no validation required
    $about = request('about');
    $price = request('price');
    $dev_id = request('dev_id');
    if ($price == "0") {
        $price = "Free";
    }

    // validate and match username and then return user_id
    $username = request('username');
    $username = validate_required($username);
    $username = validate_name($username);
    $user_id = match_username($username);

    // check if session already have username
    add_session($username);

    // add to database
    $id = add_game($name, $release_date, $about, $tag, $price, $dev_id, $user_id);
    if ($id) {
        return redirect("game_profile/$id");
    } else {
        die("Error while adding game.");
    }
});

Route::post('add_review_action', function () {
    // no validation required
    $comment = request("comment");
    $rating = request("rating");
    $game_id = request('id');

    // getting current date
    $date_string = now()->toDateTimeString();
    $date_array = explode(' ', $date_string);
    $posted_on = $date_array[0];

    // validate and match username and then return user_id
    $username = request('username');
    $username = validate_required($username);
    $username = validate_name($username);
    $user_id = match_username($username);

    // check if session already have username
    add_session($username);

    // add to database
    add_review($comment, $rating, $posted_on, $game_id, $user_id);
    return redirect("game_profile/$game_id");
});

Route::post('edit_game_action', function () {
    // validate name
    $name = request('name');
    $name = validate_required($name);
    $name = validate_name($name);

    // validate required
    $release_date = request('release_date');
    $release_date = validate_required($release_date);
    $tag = request('tag');
    $tag = validate_required($tag);
    
    // no validation required
    $id = request('id');
    $dev_id = request('dev_id');
    $user_id = request('user_id');
    $about = request('about');
    $price = request('price');
    if ($price == "0") {
        $price = "Free";
    }

    // update the database
    edit_game($id, $name, $release_date, $about, $tag, $price, $user_id, $dev_id);
    return redirect("game_profile/$id");
});

Route::post('edit_dev_action', function () {
    // validate name
    $name = request('name');
    $name = validate_required($name);
    $name = validate_name($name);

    // no validation required
    $id = request('id');
    $about = request('about');

    // update the database
    edit_dev($id, $name, $about);
    return redirect("dev_profile/$id");
});

Route::post('edit_review_action', function () {
    // validate required
    $comment = request("comment");
    $comment = validate_required($comment);

    // no validation requried
    $rating = request("rating");
    $posted_on = request('posted_on');
    $game_id = request('game_id');
    $user_id = request('user_id');
    $id = request('id');

    edit_review($comment, $rating, $posted_on, $game_id, $user_id, $id);
    return redirect("game_profile/$game_id");
});

Route::get('delete_game/{id}', function ($id) {
    // delete from database
    delete_game($id);
    return redirect("/");
});

Route::get('log_out', function () {
    // forget username from session
    Session::forget('name');
    return Redirect::back();
});


// ___________________________________________________________________________________________________________________________ Functions


// Return game data by game id, used by game_profile to display
function get_game($id)
{
    $sql = "select * from game where id=?";
    $games = DB::select($sql, array($id));
    if (count($games) != 1) {
        die("Something went wrong, invalid result: $sql");
    }
    ;
    $game = $games[0];
    return $game;
}

// return dev data by dev id, used by dev_profile to display
function get_dev($id)
{
    $sql = "select * from dev where id=?";
    $devs = DB::select($sql, array($id));
    if (count($devs) != 1) {
        die("Something went wrong, invalid result: $sql");
    }
    ;
    $dev = $devs[0];
    return $dev;
}

// return user data by user id, used by game_profile to identify who created the game item
function get_user($id)
{
    $sql = "select * from user where id=?";
    $users = DB::select($sql, array($id));
    if (count($users) != 1) {
        die("Something went wrong, invalid result: $sql");
    }
    ;
    $user = $users[0];
    return $user;
}

// return all dev data except the first one, used by the game related forms to give users dev choices
function get_all_dev()
{
    $sql = "select * from dev";
    $devs = DB::select($sql);
    unset($devs[0]);
    return $devs;
}

// return all review data for one game, used by game_profile to display them
function get_reviews($id)
{
    $sql = "select * from review where game_id=?";
    $reviews = DB::select($sql, array($id));
    foreach ($reviews as $review) {
        $reviewer = get_reviewer($review->user_id);
        $review->reviewer = $reviewer->name;
    }
    ;
    return $reviews;
}

// return user data by review id, used by game_profile to display the in review section 
function get_reviewer($id)
{
    $sql = "select * from user where id=?";
    $reviewers = DB::select($sql, array($id));
    if (count($reviewers) != 1) {
        die("Something went wrong, invalid result: $sql");
    }
    ;
    $reviewer = $reviewers[0];
    return $reviewer;
}

// add a new dev to database and return the id of that dev, used by add form
function add_dev($name, $about)
{
    $sql = "insert into dev(name, about) values (?, ?)";
    DB::insert($sql, array($name, $about));
    $id = DB::getPdo()->lastInsertId();
    return ($id);
}

// add a new game to database and return the id of that game, used by add form
function add_game($name, $release_date, $about, $tag, $price, $dev_id, $user_id)
{
    $sql = "insert into game(name, release_date, about, tag, price, dev_id, user_id) values (?, ?, ?, ?, ?, ?, ?)";
    DB::insert($sql, array($name, $release_date, $about, $tag, $price, $dev_id, $user_id));
    $id = DB::getPdo()->lastInsertId();
    return ($id);
}

// add a new review to database, used by game_profile
function add_review($comment, $rating, $posted_on, $game_id, $user_id)
{
    $sql = "insert into review(comment, rating, posted_on, game_id, user_id) values (?, ?, ?, ?, ?)";
    DB::insert($sql, array($comment, $rating, $posted_on, $game_id, $user_id));
}

// look through the user database and if found, return id
// if not, add to database and return id of that user
// used by review form and add form when adding new entry
function match_username($name)
{
    // search database for same username 
    $sql = "select id from user where name=?";
    $user_ids = DB::select($sql, array($name));
    if (count($user_ids) > 1) {
        die("Something went wrong, invalit result: $sql");
    } else if (count($user_ids) == 0) {
        // if no match, then add
        $sql = "insert into user(name) values (?)";
        DB::insert($sql, array($name));
        $user_id = DB::getPdo()->lastInsertId();
        return ($user_id);
    } else {
        // if matched, return
        $user_id = $user_ids[0]->id;
        return $user_id;
    }
}

// return average rating for a game based on reviews, used by game_profile and get_dev_rating function
function get_game_rating($reviews)
{
    $rating_array = array();
    foreach ($reviews as $review) {
        array_push($rating_array, $review->rating);
    }
    if (count($rating_array) != 0) {
        $avg_rating = array_sum($rating_array) / count($rating_array);
    } else {
        $avg_rating = 0;
    }

    // format the rating into 2 decimal point
    return number_format((float) $avg_rating, 2, '.', '');
}

// return average rating for a dev based on all the games they made, used by dev_profile and home
function get_dev_rating($id)
{
    $sql = "select * from review where game_id in (select id from game where dev_id=?)";
    $reviews = DB::select($sql, array($id));
    $avg_rating = get_game_rating($reviews);
    return $avg_rating;
}

// return other games a dev made excluding the one on display, used by game_profile to show other games from the same dev 
function get_other_games($id, $dev_id)
{
    $sql = "select * from game where dev_id=? and not id=?";
    $games = DB::select($sql, array($dev_id, $id));
    foreach ($games as $game) {
        $reviews = get_reviews($game->id);
        $rating = get_game_rating($reviews);
        $game->rating = $rating;
    }
    return $games;
}

// adding a new name entry to the current session, used by forms to retain the username 
function add_session($name)
{
    if (Session::get('name')) {
        // dd(Session::get('name'));
    } else {
        Session::put('name', $name);
    }
}

// update a game's attributes to the database, used by edit_game_form at submission
function edit_game($id, $name, $release_date, $about, $tag, $price, $user_id, $dev_id)
{
    $sql = "update game set name=?, release_date=?, about=?, tag=?, price=?, user_id=?, dev_id=? where id=?";
    DB::update($sql, array($name, $release_date, $about, $tag, $price, $user_id, $dev_id, $id));
}

// delete a game from database using game_id, this will also delete reviews for that game, used by game_profile 
function delete_game($id)
{
    $sql = "select * from review where game_id=?";
    $reviews = DB::select($sql, array($id));
    foreach ($reviews as $review) {
        $sql = "delete from review where id=?";
        DB::delete($sql, array($review->id));
    }
    $sql = "delete from game where id=?";
    DB::delete($sql, array($id));
}

// return data of a single review, used by review_edit_form to display existing values
function get_review($id)
{
    $sql = "select * from review where id=?";
    $review_array = DB::select($sql, array($id));
    if (count($review_array) != 1) {
        die("Something went wrong, invalid result: $sql");
    }
    ;
    $review = $review_array[0];
    return $review;
}

// update a review's attributes to the database, used by edit_review_form at submission
function edit_review($comment, $rating, $posted_on, $game_id, $user_id, $id)
{
    $sql = "update review set comment=?, rating=?, posted_on=?, game_id=?, user_id=? where id=?";
    DB::update($sql, array($comment, $rating, $posted_on, $game_id, $user_id, $id));
}

// update a dev's attributes to the database, used by edit_dev_form at submission
function edit_dev($id, $name, $about)
{
    $sql = "update dev set name=?, about=? where id=?";
    DB::update($sql, array($name, $about, $id));
}

// validate the names and return them, used by the forms
function validate_name($name)
{
    // check length of the name
    if (strlen($name) > 2) {
        // check special characters
        if (!preg_match('/[-_+"]/', $name)) {
            // check numbers in characters
            if (preg_match('/[0-9]+/', $name)) {
                //take out all numbers, show warning and return
                $validated_name = preg_replace("/[0-9]+/", '', $name);
                return $validated_name;
            } else {
                //no number detected and return
                return $name;
            }
        } else {
            // please exclude special characters
            dd('please exclude special characters'); // replace this with warning triggers
        }
    } else {
        // please enter longer name
        dd('please enter longer name'); // replace this with warning triggers
    }
}

// check if the iput is null or not and return them, used by the form input  
function validate_required($input)
{
    if ($input != null) {
        return $input;
    } else {
        // please enter something
        dd('this field is required.'); // replace this with warning triggers
    }
}
