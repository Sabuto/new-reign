@extends('app')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title text-center">All Users</h3>
        </div>
        <div class="panel-body">
            <p>
                <h2>Here you can edit the users with different options</h2>
            </p>
            @forelse($users as $user)
                <div>
                    <a href="admin/users/{{$user->id}}/edit">$user->name</a>
                </div>
            @empty
                <div>
                    There are no users to edit. Looks like you are the only user!!
                </div>
            @endforelse
        </div>
    </div>
@stop