@extends('layouts.master')

@section('title')
    Misfits: Home
@endsection

@section('content')
    <div class="container" id="testing-container">
        <h3 id="testing">!!!___Under Construction___!!!</h3>
        <h1 id="testing">GAME PAGE</h1>
        <p id="testing">This is a home page and will display all items</p>
        @if ($games)
        <ul>
            @foreach ($games as $game)
            <li><a id="testing" href="{{url("game_profile/$game->id")}}"><u>{{$game->name}}</u></a></li>
            @endforeach
        </ul>
        @else
            No game found.
        @endif
    </div>
@endsection