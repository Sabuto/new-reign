@extends('app')

@section('content')
    @include('partials.messages')
    <table class="table">
        <thead>
            <th>#</th>
            <th>Event</th>
            <th>Time</th>
            <th>Options</th>
        </thead>
        <tbody>
            @forelse($events as $event)
                <tr>
                    <td>{{$event->id}}</td>
                    <td>{{$event->event}}</td>
                    <td>{{$event->updated_at->diffForHumans()}}</td>
                    <td>
                        {!! Form::open(['class'=>'form-inline','method' => 'delete', 'route' => ['events.destroy', $event->id]]) !!}
                            <button class="no-button"><span class="glyphicon glyphicon-remove"></span></button>
                        {!! Form::close() !!} | <a href="{{route('events.form', $event->id)}}"><span class="glyphicon glyphicon-envelope"></span></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">You have no Events.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@stop