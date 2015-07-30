@extends('app')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1 class="panel-title">{!! $thread->subject !!}</h1>
        </div>
    </div>

    <div id="thread_{{$thread->id}}">
        @foreach($thread->messages as $message)
            @include('messages.html-message')
        @endforeach
    </div>
    <h2>Add a new message</h2>
    {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
            <!-- Message Form Input -->
    <div class="form-group">
        {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
    </div>

    @if($users->count() > 0)
        <div class="checkbox">
            @foreach($users as $user)
                <label title="{!! $user->name !!}"><input type="checkbox" name="recipients[]" value="{!! $user->id !!}">{!! $user->name !!}</label>
            @endforeach
        </div>
        @endif

                <!-- Submit Form Input -->
        <div class="form-group">
            {!! Form::submit('Reply', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form::close() !!}
@stop