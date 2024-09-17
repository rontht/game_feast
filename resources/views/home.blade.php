@extends('layouts.master')

@section('title')
GameFeast
@endsection

@section('heading')
Home
@endsection

@section('content')
<div class="container p-0" id="carousel">
    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
                aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4"
                aria-label="Slide 5"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="3000">
                <img src="{{asset('images/banner_1.png')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="{{asset('images/banner_2.png')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="{{asset('images/banner_3.png')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="{{asset('images/banner_4.png')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="{{asset('images/banner_5.png')}}" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<div class="container overflow-y-auto p-0" id="table-container">
    @if ($games)
        <table class="m-0 p-0">
            <thead>
                <tr>
                    <th>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle p-0" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false" id="home-button">
                                #
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{url('nasc')}}">ascending</a></li>
                                <li><a class="dropdown-item" href="{{url('ndsc')}}">descending</a></li>
                            </ul>
                        </div>
                    </th>
                    </th>
                    <th>name</th>
                    <th>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle p-0" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false" id="home-button">
                                average rating
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{url('rasc')}}">ascending</a></li>
                                <li><a class="dropdown-item" href="{{url('rdsc')}}">descending</a></li>
                            </ul>
                        </div>
                    </th>
                    <th>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle p-0" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false" id="home-button">
                                number of reviews
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{url('casc')}}">ascending</a></li>
                                <li><a class="dropdown-item" href="{{url('cdsc')}}">descending</a></li>
                            </ul>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($games as $game)
                    <tr>
                        <td><a href="{{url("game_profile/$game->id")}}" id="table-link">{{$game->no}}</a></td>
                        <td><a href="{{url("game_profile/$game->id")}}" id="table-link">{{$game->name}}</a></td>
                        <td><a href="{{url("game_profile/$game->id")}}" id="table-link">{{$game->rating}}</a></td>
                        <td><a href="{{url("game_profile/$game->id")}}" id="table-link">{{$game->review_count}}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="container h-100" id="no-review-box">
            <div id="no-review" class="">
                <i class="lni lni-comments mx-1 fs-1"></i>
                <span class="fs-1">Sorry, there's no game in our database.</span>
            </div>
        </div>
    @endif
</div>

@endsection

@section('forms')
<div id="form_1" class="custom_form overflow-hidden">
    @include('forms.add_form')
</div>
@endsection