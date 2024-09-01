@extends('layouts.master')

@section('title')
    GameFeast: Browse Developers
@endsection

@section('heading')
    Browse Developers
@endsection

@section('content')
    <div class="container" id="testing-container">
        <h3 id="testing">!!!___Under Construction___!!!</h3>
        <h1 id="testing">DEV PAGE</h1>
        <p id="testing">This will display developers.</p>
        @if ($devs)
        <ul>
            @foreach ($devs as $dev)
            <li><a id="testing" href="{{url("dev_profile/$dev->id")}}"><u>{{$dev->name}}</u></a></li>
            @endforeach
        </ul>
        @else
            No game found.
        @endif  
    </div>
@endsection