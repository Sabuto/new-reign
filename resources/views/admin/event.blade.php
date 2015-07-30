@extends('app')

@section('content')
    <h3 class="page-heading">Create an event</h3>
    <div class="panel panel-primary">
        <div class="panel-body">
            {!! Form::open(['route' => 'admin.event']) !!}
                <!-- User Form Input -->
                <div class="form-group @if($errors->has('user')) has-error @endif">
                    {!! Form::label('user', 'User (id):') !!}
                    {!! Form::text('user', old('user'), ['class' => 'form-control']) !!}
                    @if($errors->has('user')) <p class="help-block">{{$errors->first('user')}}</p>@endif
                </div>
                <!-- Event Form Input -->
                <div class="form-group @if($errors->has('event')) has-error @endif">
                    {!! Form::label('event', 'Event:') !!}
                    {!! Form::textarea('event', old('event'), ['class' => 'form-control']) !!}
                    @if($errors->has('event')) <p class="help-block">{{$errors->first('event')}}</p>@endif
                </div>
                <div class="form-group">
                    {!! Form::submit('Create Event', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop