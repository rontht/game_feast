<?php

use Illuminate\Support\Facades\Route;

// ___________________________________________________________________________________________________________________________ Routes


// Route to Home/Default Page
Route::get('/', function () {
    $games = get_all_game(); // to display on the table
    $devs = get_all_dev(); // for add form dev select
    return view('home')->with('games', $games)->with('devs', $devs);
});

// Route to Game Page, currently not implemented in the website
Route::get('game', function () {
    $sql = "select * from game";
    $games = DB::select($sql); // get all games
    $devs = get_all_dev(); // for add form dev select
    return view('games.game')->with('games', $games)->with('devs', $devs);
});

// Route to Game Profile Page
Route::get('game_profile/{id}', function ($id) {
    // get game's detail and reviews
    $game = get_game($id);
    $user = get_user($game->user_id);
    $dev = get_dev($game->dev_id);
    $reviews = get_reviews($id);
    $devs = get_all_dev(); // for add form dev select
    $avg_rating = get_game_rating($reviews); // calculate avg rating based on all reviews
    $other_games = get_other_games($game->id, $game->dev_id); // to display games in other section

    // get dev_info for game edit form
    $dev_info = get_dev($game->dev_id);

    return view('games.game_profile')->with('game', $game)->with('user', $user)->with('dev', $dev)->with('reviews', $reviews)->with('devs', $devs)->with('avg_rating', $avg_rating)->with('other_games', $other_games)->with('dev_info', $dev_info);
});

// Route to Game Profile Page, used when editing reviews
Route::get('game_profile/{game_id}/{review_id}', function ($game_id, $review_id) {
    $game = get_game($game_id);
    $user = get_user($game->user_id);
    $dev = get_dev($game->dev_id);
    $reviews = get_reviews($game_id);
    $devs = get_all_dev(); // for add form dev select
    $avg_rating = get_game_rating($reviews); // calculate avg rating based on all reviews
    $other_games = get_other_games($game->id, $game->dev_id); // to display games in other section

    //for editing review
    $review_to_edit = get_review($review_id);

    // get dev_info for game edit
    $dev_info = get_dev($game->dev_id);

    return view('games.game_profile')->with('game', $game)->with('user', $user)->with('dev', $dev)->with('reviews', $reviews)->with('devs', $devs)->with('avg_rating', $avg_rating)->with('other_games', $other_games)->with('review_to_edit', $review_to_edit)->with('dev_info', $dev_info);
});

// Route to Dev Page, display all developers
Route::get('dev', function () {
    // select all except unknown dev
    $sql = "select * from dev where not id=1";
    $devs = DB::select($sql);

    // for design purpose get first letter of dev name
    foreach ($devs as $dev) {
        $first_char = substr($dev->name, 0, 1);
        $rating = get_dev_rating($dev->id);
        $dev->first_char = $first_char;
        $dev->rating = $rating;
    }

    // select unknown dev
    $sql = "select * from dev where id=1";
    $un_dev = DB::select($sql);
    $unknown = $un_dev[0];

    // for design purpose get first letter of dev name
    $first_char = substr($unknown->name, 0, 1);
    $unknown->first_char = $first_char;


    return view('devs.dev')->with('devs', $devs)->with('unknown', $unknown);
});

// Route to Dev Profile Page
Route::get('dev_profile/{id}', function ($id) {
    // get all games that developer made
    $sql = "select * from game where dev_id=?";
    $games = DB::select($sql, array($id));
    foreach ($games as $game) {
        $reviews = get_reviews($game->id);
        $rating = get_game_rating($reviews);
        $game->rating = $rating;
    }

    // get all detail of the selected dev
    $dev = get_dev($id);

    // for design purpose get first letter of dev name
    $first_char = substr($dev->name, 0, 1);
    $dev->first_char = $first_char;

    $devs = get_all_dev(); // for add form dev select
    $avg_rating = get_dev_rating($id); // calculate avg rating based on all avg ratings of the games that the dev made
    return view('devs.dev_profile')->with('dev', $dev)->with('games', $games)->with('devs', $devs)->with('avg_rating', $avg_rating);
});


// ___________________________________________________________________________________________________________________________ Actions


// Add a new developer action
Route::post('add_dev_action', function () {
    // initialize array
    $errors = array();

    // no validation required
    $about = request('dev_about');

    // name validation needed
    $name = request('dev_name');

    // validate error array
    $errors = name_validation($name, "Error! Please enter Developer Name.", $errors);

    // if errors, redirect back with errors and old input
    if (count($errors) != 0) {
        return redirect()->back()->withErrors($errors)->withInput();
    }

    // if validation successful, proceed to filter numbers from name
    $errors = number_detection($name, "Warning! numbers in the username were detected and removed.", $errors);

    // remove numbers from name
    $name = preg_replace("/[0-9]+/", '', $name);

    $duplicate = dev_duplicate_check($name, $errors);
    if (count($duplicate) != 0) {
        return redirect()->back()->withErrors($duplicate);
    }

    // add to database
    $id = add_dev($name, $about);
    if ($id) {
        if (count($errors) != 0) {
            // if there's a warning redirect with $errors message
            return redirect("dev_profile/$id")->withErrors($errors);
        } else {
            // no problems. clean redirect
            return redirect("dev_profile/$id");
        }
    } else {
        die("Error while adding game.");
    }
});

// Add a new game action
Route::post('add_game_action', function () {
    // initialize array
    $errors = array();

    // no validation required
    $about = request('game_about');
    $dev_id = request('game_dev_id');

    // name validation required
    $username = request('game_username');
    $errors = name_validation($username, "Error! Please enter your username.", $errors);
    $name = request('game_name');
    $errors = name_validation($name, "Error! Please enter the game's name", $errors);

    // validate required fields
    $release_date = request('game_release_date');
    $errors = required_validation($release_date, "Error! Please enter the game's release date.", $errors);
    $tag = request('game_tag');
    $errors = required_validation($tag, "Error! Please add at least one tag.", $errors);

    // number only field
    $price = request('game_price');
    $errors = number_only_validation($price, $errors);
    if ($price == "0") {
        $price = "Free";
    }

    // if errors, redirect back with errors and old input
    if (count($errors) != 0) {
        return redirect()->back()->withErrors($errors)->withInput();
    }

    // if validation successful, proceed to filter numbers from the names
    $errors = number_detection($username, "Warning! numbers in the username were detected and removed.", $errors);
    $errors = number_detection($name, "Warning! numbers in the game name were detected and removed.", $errors);

    // remove numbers from names
    $username = preg_replace("/[0-9]+/", '', $username);
    $name = preg_replace("/[0-9]+/", '', $name);

    // match username to check if it already exist in the database
    $user_id = match_username($username);

    // check if session already have username
    add_session($username);

    // add to database
    $id = add_game($name, $release_date, $about, $tag, $price, $dev_id, $user_id);

    if ($id) {
        if (count($errors) != 0) {
            // if there's a warning redirect with $errors message
            return redirect("game_profile/$id")->withErrors($errors);
        } else {
            // no problems. clean redirect
            return redirect("game_profile/$id");
        }
    } else {
        die("Error while adding game.");
    }
});

// Add a new review action
Route::post('add_review_action', function () {
    // initialize array
    $errors = array();

    // no validation required
    $rating = request("review_rating");
    $game_id = request('review_game_id');

    // getting current date
    $date_string = now()->toDateTimeString();
    $date_array = explode(' ', $date_string);
    $posted_on = $date_array[0];

    // validate and match username and then return user_id
    $username = request('review_username');
    $errors = name_validation($username, "Error! Please enter your username.", $errors);

    // validate required
    $comment = request("review_comment");
    $errors = required_validation($comment, "Please enter a comment for your review.", $errors);

    // if errors, redirect back with errors and old input
    if (count($errors) != 0) {
        return redirect()->back()->withErrors($errors)->withInput();
    }
    
    // detect fake reviews
    $errors = detect_fake_reviews($comment, $errors);
    
    // if errors, redirect back with errors and old input
    if (count($errors) != 0) {
        return redirect()->back()->withErrors($errors)->withInput();
    }
    
    // if validation successful, proceed to filter numbers from the names
    // $errors = number_detection($username, "Warning! numbers in the username were detected and removed.", $errors);

    // remove numbers from names
    $username = preg_replace("/[0-9]+/", '', $username);

    // match username from database and return new or existing id
    $user_id = match_username($username);

    // a user can post one review per game
    $limit_exceed = review_limit_check($user_id, $game_id, $errors);
    if (count($limit_exceed) != 0) {
        return redirect()->back()->withErrors($limit_exceed);
    }

    // check if session already have username. if not, add one
    add_session($username);

    // add to database
    add_review($comment, $rating, $posted_on, $game_id, $user_id);
    if (count($errors) != 0) {
        // if there's a warning redirect with $errors message
        return redirect("game_profile/$game_id")->withErrors($errors);
    } else {
        // no problems. clean redirect
        return redirect("game_profile/$game_id");
    }
});

// update game detail action
Route::post('edit_game_action', function () {
    // initialize array
    $errors = array();

    // no validation required
    $id = request('game_id_edit');
    $user_id = request('game_user_id_edit');
    $dev_id = request('game_dev_id_edit');
    $about = request('game_about_edit');

    // validate name
    $name = request('game_name_edit');
    $errors = name_validation($name, "Error! Please enter the game's name.", $errors);

    // validate required
    $release_date = request('game_release_date_edit');
    $errors = required_validation($release_date, "Error! Please enter the game's release date.", $errors);
    $tag = request('game_tag_edit');
    $errors = required_validation($tag, "Errors! Please enter at least one tag.", $errors);

    // number only field
    $price = request('game_price_edit');
    $errors = number_only_validation($price, $errors);
    if ($price == "0") {
        $price = "Free";
    }

    // if errors, redirect back with errors and old input
    if (count($errors) != 0) {
        return redirect()->back()->withErrors($errors)->withInput();
    }

    // if validation successful, proceed to filter numbers from the names
    $errors = number_detection($name, "Warning! numbers in the game name were detected and removed.", $errors);

    // remove numbers from names
    $name = preg_replace("/[0-9]+/", '', $name);

    // update the database
    edit_game($id, $name, $release_date, $about, $tag, $price, $user_id, $dev_id);

    if (count($errors) != 0) {
        // if there's a warning redirect with $errors message
        return redirect("game_profile/$id")->withErrors($errors);
    } else {
        // no problems. clean redirect
        return redirect("game_profile/$id");
    }
});

// update dev detail action
Route::post('edit_dev_action', function () {
    // initialize array
    $errors = array();

    // no validation required
    $id = request('dev_id_edit');
    $about = request('dev_about_edit');

    // validate name
    $name = request('dev_name_edit');
    $errors = name_validation($name, "Error! Please enter the dev's name.", $errors);

    // if errors, redirect back with errors and old input
    if (count($errors) != 0) {
        return redirect()->back()->withErrors($errors)->withInput();
    }

    // if validation successful, proceed to filter numbers from the names
    $errors = number_detection($name, "Warning! numbers in the game name were detected and removed.", $errors);

    // remove numbers from names
    $name = preg_replace("/[0-9]+/", '', $name);

    // update the database
    edit_dev($id, $name, $about);

    if (count($errors) != 0) {
        // if there's a warning redirect with $errors message
        return redirect("dev_profile/$id")->withErrors($errors);
    } else {
        // no problems. clean redirect
        return redirect("dev_profile/$id");
    }
});

// update review detail action
Route::post('edit_review_action', function () {
    // initialize array
    $errors = array();

    // no validation requried
    $rating = request("review_rating_edit");
    $posted_on = request('review_posted_on_edit');
    $game_id = request('review_game_id_edit');
    $user_id = request('review_user_id_edit');
    $id = request('review_id_edit');

    // validate required
    $comment = request("review_comment_edit");
    $errors = required_validation($comment, "Please enter a comment for your review.", $errors);

    // if errors, redirect back with errors and old input
    if (count($errors) != 0) {
        return redirect()->back()->withErrors($errors)->withInput();
    }

    // if no error, proceed
    edit_review($comment, $rating, $posted_on, $game_id, $user_id, $id);
    return redirect("game_profile/$game_id");
});

// delete game action
Route::get('delete_game/{id}', function ($id) {
    // delete game from database
    delete_game($id);
    return redirect("/");
});

// delete review action
Route::get('delete_review/{game_id}/{review_id}', function ($game_id, $review_id) {
    // delete review from dataabse
    $sql = "delete from review where id=?";
    DB::delete($sql, array($review_id));
    return redirect("game_profile/$game_id");
});

// delete dev action, this will put all games made by dev to unknown dev
Route::get('delete_dev/{id}', function ($id) {
    // select all the games of the dev
    $sql = "select * from game where dev_id=?";
    $games = DB::select($sql, array($id));
    if (count($games) != 0) {
        foreach ($games as $game) {
            // move all games to unknown developer section
            $sql = "update game set dev_id=? where id=?";
            DB::update($sql, array(1, $game->id));
        }
    }
    // then delete the dev
    $sql = "delete from dev where id=?";
    DB::delete($sql, array($id));
    return redirect("dev");
    ;
});

// log out current user from the session
Route::get('log_out', function () {
    // forget username from session
    Session::forget('name');
    return redirect()->back();
});


// ___________________________________________________________________________________________________________________________ Sorting Routes


// Sort rating in ascending hence rasc
Route::get('rasc', function () {
    $games = get_all_game();
    $devs = get_all_dev();
    usort($games, function ($a, $b) {
        return $a->rating <=> $b->rating;
    });
    return view('home')->with('games', $games)->with('devs', $devs);
});

// Sort rating in deascending hence rdsc
Route::get('rdsc', function () {
    $games = get_all_game();
    $devs = get_all_dev();
    usort($games, function ($a, $b) {
        return $b->rating <=> $a->rating;
    });
    return view('home')->with('games', $games)->with('devs', $devs);
});

// Sort review count in ascending hence casc
Route::get('casc', function () {
    $games = get_all_game();
    $devs = get_all_dev();
    usort($games, function ($a, $b) {
        return $a->review_count <=> $b->review_count;
    });
    return view('home')->with('games', $games)->with('devs', $devs);
});

// Sort review count in deascending hence cdsc
Route::get('cdsc', function () {
    $games = get_all_game();
    $devs = get_all_dev();
    usort($games, function ($a, $b) {
        return $b->review_count <=> $a->review_count;
    });
    return view('home')->with('games', $games)->with('devs', $devs);
});

// Sort number in ascending hence nasc
Route::get('nasc', function () {
    $games = get_all_game();
    $devs = get_all_dev();
    usort($games, function ($a, $b) {
        return $a->no <=> $b->no;
    });
    return view('home')->with('games', $games)->with('devs', $devs);
});

// Sort number in deascending hence ndsc
Route::get('ndsc', function () {
    $games = get_all_game();
    $devs = get_all_dev();
    usort($games, function ($a, $b) {
        return $b->no <=> $a->no;
    });
    return view('home')->with('games', $games)->with('devs', $devs);
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
    $user = $users[0];
    return $user;
}

// return all dev data except the first one,
// used by the game related forms to give users dev choices
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

// return average rating for a game based on reviews,
// used by game_profile and get_dev_rating function
function get_game_rating($reviews)
{
    $rating_array = array();
    foreach ($reviews as $review) {
        $rating_array[] = $review->rating;
    }
    if (count($rating_array) != 0) {
        $avg_rating = array_sum($rating_array) / count($rating_array);
    } else {
        $avg_rating = 0;
    }

    // format the rating into 2 decimal point
    return number_format((float) $avg_rating, 2, '.', '');
}

// return average rating for a dev based on all the games they made,
// used by dev_profile and home
function get_dev_rating($id)
{
    $sql = "select * from review where game_id in (select id from game where dev_id=?)";
    $reviews = DB::select($sql, array($id));
    $avg_rating = get_game_rating($reviews);
    return $avg_rating;
}

// return other games a dev made excluding the one on display, 
// used by game_profile to show other games from the same dev 
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
    // Only if session->'name' doesn't exist, add a new one
    if (!Session::get('name')) {
        Session::put('name', $name);
    }
}

// update a game's attributes to the database, used by edit_game_form at submission
function edit_game($id, $name, $release_date, $about, $tag, $price, $user_id, $dev_id)
{
    $sql = "update game set name=?, release_date=?, about=?, tag=?, price=?, user_id=?, dev_id=? where id=?";
    DB::update($sql, array($name, $release_date, $about, $tag, $price, $user_id, $dev_id, $id));
}

// delete a game from database using game_id, 
// this will also delete reviews for that game, used by game_profile 
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

// get all games from database including ratings, review count and numbering
// used by home page to display the table
function get_all_game()
{
    $sql = "select * from game";
    $games = DB::select($sql);
    $no = 1;
    foreach ($games as $game) {
        $reviews = get_reviews($game->id);
        $review_count = count($reviews);
        $rating = get_game_rating($reviews);
        $game->rating = $rating;
        $game->review_count = $review_count;
        $game->no = $no;
        $no++;
    }
    return $games;
}

// ___________________________________________________________________________________________________________________________ Validations

// name validation method for names (usernames, game names, dev names)
function name_validation($name, $error_message, array $errors)
{
    // check if name is empty
    if (empty($name)) {
        array_push($errors, $error_message);
    }
    // check if name length is less than or equal to 2
    if (strlen($name) <= 2) {
        array_push($errors, "Error! A name must have more than 2 characters.");
    }
    // check if name contains special characters
    if (preg_match('/[-_+"]/', $name)) {
        array_push($errors, 'Error! A name must not contain special characters (-, _, +, ").');
    }
    return $errors;
}

// number detection method for names (usernames, game names, dev names)
function number_detection($name, $error_message, array $errors)
{
    // check if name contains numbers
    if (preg_match('/[0-9]+/', $name)) {
        array_push($errors, $error_message);
    }
    return $errors;
}

// required validation method for required input fields
function required_validation($input, $error_message, array $errors)
{
    // check if input is empty
    if (empty($input)) {
        array_push($errors, $error_message);
    }
    return $errors;
}

// number only validation method for price field
function number_only_validation($input, array $errors)
{
    // check if input is Free
    if ($input != "Free") {
        // check if input contains non-number
        if (!is_numeric($input)) {
            array_push($errors, "Error! Please enter numbers only in the price field");
        }
    }

    return $errors;
}

// a user can post only one review per game, used by add_review_form
function review_limit_check($user_id, $game_id, array $errors)
{
    // search database for a match
    $sql = "select * from review where user_id = ? and game_id = ?";
    $review = DB::select($sql, array($user_id, $game_id));
    if (count($review) > 1) {
        die("Something went wrong, invalit result: $sql");
    } else if (count($review) === 1) {
        // if found, push error
        array_push($errors, "Error! You have already posted a review for this game.");
    }
    return $errors;
}

// 2 dev with the same name cannot exist, used by add_form
function dev_duplicate_check($dev_name, array $errors)
{
    $sql = "select id from dev where name=?";
    $id = DB::select($sql, array($dev_name));
    if (count($id) > 1) {
        die("Something went wrong, invalit result: $sql");
    } else if (count($id) === 1) {
        array_push($errors, "Error! The developer you are trying to add already exists.");
    }
    return $errors;
}


// ___________________________________________________________________________________________________________________________ Detecting fake reviews
// Detect codes such as html, css, script etc.
// Regex for script from https://stackoverflow.com/questions/16585635/how-to-find-script-tag-from-the-string-with-javascript-regular-expression
// Regex for html from https://gist.github.com/gavin-asay/6cd089ca72b9810957254ec6a0cfced7
// Regex for links from https://stackoverflow.com/questions/3809401/what-is-a-good-regular-expression-to-match-a-url
function detect_code($comment)
{
    $codes = [
        "/<script[\s\S]*?>[\s\S]*?<\/script>/", // script Regex
        "/\<(?<tag>[a-z][a-z0-9\-]*)(\s+([\s\S]*?))?\/?\>(([\s\S]*?)\<\/(?P=tag)\>)?/", // html Regex
        "/(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/"
    ];
    foreach ($codes as $code) {
        if (preg_match($code, $comment)) {
            dd("FAKEEE");
        }
    }
    dd("ya good");
}

// Detect really short comments with common words
function detect_common($comment)
{
    $common_words = ['good', 'excellent', 'best', 'amazing', 'love', 'hate'];

    if (str_word_count($comment) < 4) {
        foreach ($common_words as $common_word) {
            if (stripos($comment, $common_word) !== false) {
                dd("fake review!", $comment);
            }
        }
    }
    dd("all good", $comment);
}

// Detect repeated common words
// although it's not the same, the function is inspired by https://www.geeksforgeeks.org/php-program-to-print-all-duplicate-characters-in-a-string/
function detect_repetition($comment)
{
    $common_words = ['good', 'excellent', 'best', 'amazing', 'love', 'hate'];

    // split the string and count them
    $words = array_count_values(explode(" ", $comment));
    // example out put $words = ["hello" => 4, "good" => 5]

    foreach ($words as $word => $count) {
        // if the word count is 3 or above
        if ($count >= 3) {
            // loop common words
            foreach ($common_words as $common_word) {
                // match with each common word
                if (stripos($word, $common_word) !== false) {
                    // if match
                    dd("fake review!", $word, $count);
                }
            }
        }
    }
    dd("all good");
}

// combined function
function detect_fake_reviews($comment,array $errors)
{
    $common_words = ['good', 'excellent', 'best', 'amazing', 'love', 'hate', 'bad'];
    $codes = [
        // script Regex
        "/<script[\s\S]*?>[\s\S]*?<\/script>/",

        // html Regex
        "/\<(?<tag>[a-z][a-z0-9\-]*)(\s+([\s\S]*?))?\/?\>(([\s\S]*?)\<\/(?P=tag)\>)?/",

        // link Regex
        "/(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/"
    ];
    $error_message = "Error! Malicious comment detected.";

    // detect links, scripts, htmls
    foreach ($codes as $code) {
        if (preg_match($code, $comment)) {
            array_push($errors, $error_message);
            return $errors;
        }
    }

    // detect common words in short comments
    if (str_word_count($comment) < 4) {
        foreach ($common_words as $common_word) {
            if (stripos($comment, $common_word) !== false) {
                array_push($errors, $error_message);
                return $errors;
            }
        }
    }

    // detect repeated common words
    // split the string and count them
    $words = array_count_values(explode(" ", $comment));
    // example out put $words = ["hello" => 4, "good" => 5]

    foreach ($words as $word => $count) {
        // if the word count is 3 or above
        if ($count >= 3) {

            // loop common words
            foreach ($common_words as $common_word) {
                // match with each common word
                if (stripos($word, $common_word) === false) {
                    // if match
                    array_push($errors, $error_message);
                    return $errors;
                }
            }
        }
    }
    return $errors;
}