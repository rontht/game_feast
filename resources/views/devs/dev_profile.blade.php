@extends('layouts.master')

@section('title')
GameFeast: {{$dev->name}}
@endsection

@section('heading')
<a href="{{ url()->previous() }}" id="go-back-button"><i class="lni lni-arrow-left"></i></a>
<span>Developer Info</span>
@endsection

@section('content')
<div class="container" id="testing-container">
    <h3 id="testing">!!!___Under Construction___!!!</h3>
    <a href="{{ url()->previous() }}">Go Previous</a>
    <h1 id="testing">{{$dev->name}} {{$avg_rating}}</h1>
    <p id="testing">{{$dev->about}}</p>
    @if ($dev->id === 1)
        <button id="update-dev-button" onclick="showForm(3)" type="button" disabled><i
                class="lni lni-cogs"></i>UPDATE</button>
        <button id="delete-dev-button" type="button" onclick='window.location="{{url("delete_dev/$dev->id")}}"' disabled>
            <i class="lni lni-trash-can pe-2"></i>DELETE
        </button>
    @else
        <button id="update-dev-button" onclick="showForm(3)" type="button"><i class="lni lni-cogs"></i>UPDATE</button>
        <button id="delete-dev-button" type="button" onclick='window.location="{{url("delete_dev/$dev->id")}}"'>
            <i class="lni lni-trash-can pe-2"></i>DELETE
        </button>
    @endif
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

@section('forms')
<div id="form_1" class="custom_form overflow-hidden">
    @include('forms.add_form')
</div>
<div id="form_3" class="custom_form overflow-hidden">
    @include('forms.edit_dev_form')
</div>
@endsection