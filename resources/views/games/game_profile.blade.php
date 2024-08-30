@extends('layouts.master')

@section('title')
    Misfits: game_name
@endsection

@section('content')
    <div class="container" id="testing-container">
        <h3 id="testing">!!!___Under Construction___!!!</h3>
        <h1 id="testing">{{$game->name}}</h1>
        <p id="testing">{{$game->tag}}</p>
        <a id="testing" href="{{url("dev_profile/$dev->id")}}"><u>{{$dev->name}}</u></a>
        <p id="testing">{{$game->about}}</p>
        <!-- might be able to use cards from bootstrap for reviews -->
        <ul>
            <li id="testing">review 1</li>
            <li id="testing">review 2</li>
            <li id="testing">review 3</li>
            <li id="testing">review 4</li>
        </ul>
    </div>
@endsection