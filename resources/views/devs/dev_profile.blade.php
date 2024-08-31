@extends('layouts.master')

@section('title')
    GameFeast: {{$dev->name}}
@endsection

@section('content')
    <div class="container" id="testing-container">
        <h3 id="testing">!!!___Under Construction___!!!</h3>
        <h1 id="testing">{{$dev->name}}</h1>
        <p id="testing">{{$dev->about}}</p>
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