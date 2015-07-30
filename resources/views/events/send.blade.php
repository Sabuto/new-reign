@extends('app')

@section('content')
    @include('partials.messages')
    <h2 class="page-heading">Send an Event</h2>
    {!! Form::open(['route' => ['events.send', $event->id]]) !!}
        <!-- User Form Input -->
        <div class="form-group">
            {!! Form::label('user', 'User (id):') !!}
            {!! Form::text('user', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Event Form Input -->
        <div class="form-group">
            {!! Form::label('event', 'Event:') !!}
            {!! Form::textarea('event', $event->event, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
        </div>
    <div class="form-group">
        {!! Form::submit('Send event', ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}
@stop