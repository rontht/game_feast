@extends('layouts.master')

@section('title')
GameFeast
@endsection

@section('heading')
Home
@endsection

@section('content')
<!-- Games -->
@if ($games)
    <div id="card-container">
        <div class="row" id="card-holder">
            @foreach ($games as $game)
                <div class="col-2">
                    <div class="card" style="width: 10rem; height: 10rem; margin: 10px 0;">
                        <!-- <img src="..." class="card-img-top" alt="..."> -->
                        <a href="{{url("game_profile/$game->id")}}">
                            <div class="card-body">
                                <h5 class="card-title">{{$game->name}}</h5>
                                <p class="card-text"></p>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- <a id="testing" href="{{url("game_profile/$game->id")}}"><u>{{$game->name}}</u></a> -->
            @endforeach
        </div>
    </div>
@else
    No game found.
@endif
@endsection