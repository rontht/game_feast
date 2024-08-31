@extends('layouts.master')

@section('title')
    GameFeast: {{$game->name}}
@endsection

@section('content')
    <div class="container" id="testing-container">
        <h3 id="testing">!!!___Under Construction___!!!</h3>
        <h1 id="testing">{{$game->name}}</h1>
        <p id="testing">{{$game->tag}}</p>
        <a id="testing" href="{{url("dev_profile/$dev->id")}}"><u>{{$dev->name}}</u></a>
        <p id="testing">{{$game->about}}</p>
        <!-- might be able to use cards from bootstrap for reviews -->
        @if ($reviews)
        <ul>
            @foreach ($reviews as $review)
            <li>
                <p id="testing">{{$review->reviewer}}</p>
                <p id="testing">{{$review->rating}} {{$review->posted_on}}</p>
                <p id="testing">{{$review->comment}}</p>
            </li>
            @endforeach
        </ul>
        @else
            No game found.
        @endif  
    </div>
@endsection