<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $sql = "select * from game";
    $games = DB::select($sql);
    return view('home')->with('games', $games);
});

Route::get('sidebar', function () {
    return view('layouts.sidebar');
});

Route::get('game', function () {
    $sql = "select * from game";
    $games = DB::select($sql);
    return view('games.game')->with('games', $games);
});

Route::get('game_profile/{id}', function ($id) {
    $game = get_game($id);
    $dev = get_dev($game->dev_id);
    $reviews = get_reviews($id);
    return view('games.game_profile')->with('game', $game)->with('dev', $dev)->with('reviews', $reviews);
});

Route::post('add_game_action', function() {
    $name = request('name');
    $release_date = request('release_date');
    $about = request('about');
    $tag = request('tag');
    $price = request('price');
    $dev_id = 1;
    $user_id = 1;
    $id = add_game($name, $release_date, $about, $tag, $price, $dev_id, $user_id);
    if($id) {
        return redirect("game_profile/$id");
    } else {
        die("Error while adding game.");
    }
});

Route::post('add_review_action', function() {
    $comment = request("comment");
    
    // string to integer
    $rating_string = request("rating");
    $rating = (int)$rating_string;
    $game_id_string = request('id');
    $game_id = (int)$game_id_string;

    // getting current date
    $date_string = now()->toDateTimeString();
    $date_array = explode(' ', $date_string);
    $posted_on = $date_array[0];

    // match username and return user_id
    $username = request('name');
    $user_id = match_username($username);

    add_review($comment, $rating, $posted_on, $game_id, $user_id);
    return redirect("game_profile/$game_id");
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
    return view('devs.dev_profile')->with('dev', $dev)->with('games', $games);
});

function get_game($id) {
    $sql = "select * from game where id=?";
    $games = DB::select($sql, array($id));
    if (count($games)!=1) {
        die("Something went wrong, invalid result: $sql");
    };
    $game = $games[0];
    return $game;
}

function get_dev($id) {
    $sql = "select * from dev where id=?";
    $devs = DB::select($sql, array($id));
    if (count($devs)!=1) {
        die("Something went wrong, invalid result: $sql");
    };
    $dev = $devs[0];
    return $dev;
}

function get_reviews($id) {
    $sql = "select * from review where game_id=?";
    $reviews = DB::select($sql, array($id));
    foreach($reviews as $review) {
        $reviewer = get_reviewer($review->user_id);
        $review->reviewer = $reviewer->name;
    };
    return $reviews;
}

function get_reviewer($id) {
    $sql = "select * from user where id=?";
    $reviewers = DB::select($sql, array($id));
    if (count($reviewers)!=1) {
        die("Something went wrong, invalid result: $sql");
    };
    $reviewer = $reviewers[0];
    return $reviewer;
}

function add_game($name, $release_date, $about, $tag, $price, $dev_id, $user_id) {
    $sql = "insert into game(name, release_date, about, tag, price, dev_id, user_id) values (?, ?, ?, ?, ?, ?, ?)";
    DB::insert($sql, array($name, $release_date, $about, $tag, $price, $dev_id, $user_id));
    $id = DB::getPdo()->lastInsertId();
    return($id);
}

function add_review($comment, $rating, $posted_on, $game_id, $user_id) {
    $sql = "insert into review(comment, rating, posted_on, game_id, user_id) values (?, ?, ?, ?, ?)";
    DB::insert($sql, array($comment, $rating, $posted_on, $game_id, $user_id));
}

function match_username($name) {
    // search database for same username 
    $sql = "select id from user where name=?";
    $user_ids = DB::select($sql, array($name));
    if (count($user_ids)>1) {
        die("Something went wrong, invalit result: $sql");
    } else if (count($user_ids)==0) {
        // if no match, then add
        $sql = "insert into user(name) values (?)";
        DB::insert($sql, array($name));
        $user_id = DB::getPdo()->lastInsertId();
        return($user_id);
    } else {
        // if matched, return
        $user_id = $user_ids[0]->id;
        return $user_id;
    };
}