@extends('app')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-heading">Users in your City</h4>
        </div>
        <div class="panel-body">
            <table class="table">
                <tr>
                    <th>Username</th>
                    <th>Rank</th>
                </tr>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->rank->name}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop