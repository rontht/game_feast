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