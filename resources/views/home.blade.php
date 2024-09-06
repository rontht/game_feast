@extends('layouts.master')

@section('title')
GameFeast
@endsection

@section('heading')
Home
@endsection

@section('content')
<!-- Try doing manual cells instead of table -->
<div class="container overflow-y-auto p-0" id="table-container">
    <table class="table m-0 p-0">
        <thead table>
            <tr>
                <th>#</th>
                <th>name</th>
                <th>rating</th>
                <th>num of reviews</th>
            </tr>
        </thead>
        <tbody>
            @if ($games)
                <a>
                    @foreach ($games as $game)
                        <tr>
                            <td>{{$game->id}}</td>
                            <td>{{$game->name}}</td>
                            <td>{{$game->id}}</td>
                            <td>{{$game->id}}</td>
                        </tr>
                    @endforeach
                </a>
            @else
                Sorry, no game found in the database.
            @endif
        </tbody>
    </table>
</div>

@endsection

@section('forms')
<div id="form_1" class="custom_form overflow-hidden">
    @include('forms.add_form')
</div>
@endsection