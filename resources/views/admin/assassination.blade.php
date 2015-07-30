@extends('app')

@section('content')
    @foreach($targets as $target)
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">{{$target->name}}</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <p>Bounty: &pound;{{number_format($target->bounty, 1)}}</p>
                        <p>City: {{number_format($target->city)}}</p>
                    </div>
                    <div class="col-md-6">
                        <p>Defence: {{number_format($target->defence, 1)}}</p>
                        <p>Next Travel: {{$target->next_travel->diffForHumans()}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center">Users Who are assigned to this target.</p>
                        @foreach($target->users as $user)
                            <p>{{$user->name}}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@stop