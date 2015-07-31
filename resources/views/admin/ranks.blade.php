@extends('app')

@section('content')
    <ul>
        @foreach($ranks as $rank)
            <li>{{$rank->name}}</li>
        @endforeach
    </ul>
@stop