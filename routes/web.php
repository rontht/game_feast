<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $sql = "select * from game";
    $games = DB::select($sql);
    return view('home')->with('games', $games);
});

Route::get('game', function () {
    $sql = "select * from game";
    $games = DB::select($sql);
    return view('games.game')->with('games', $games);
});

Route::get('game_profile/{id}', function ($id) {
    $game = get_game($id);
    $dev = get_dev($game->dev_id);
    return view('games.game_profile')->with('game', $game)->with('dev', $dev);
});

Route::get('dev.dev', function () {
    return view('dev');
});

Route::get('dev_profile/{id}', function ($id) {
    $sql = "select * from game where dev_id=?";
    $games = DB::select($sql, array($id));
    $dev = get_dev($id);
    return view('devs.dev_profile')->with('dev', $dev)->with('games', $games);
});

function get_game($id) {
    $sql = "select * from game where id=?";
    $games = DB::select ($sql, array($id));
    if (count($games)!=1) {
        die("Something went wrong, invalid result: $sql");
    };
    $game = $games[0];
    return $game;
}

function get_dev($id) {
    $sql = "select * from dev where id=?";
    $devs = DB::select ($sql, array($id));
    if (count($devs)!=1) {
        die("Something went wrong, invalid result: $sql");
    };
    $dev = $devs[0];
    return $dev;
}