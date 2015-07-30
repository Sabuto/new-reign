@extends('app')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1 class="panel-title">Create a new message</h1>
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => 'messages.store']) !!}
                <!-- Subject Form Input -->
                <div class="form-group">
                    {!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}
                    {!! Form::text('subject', null, ['class' => 'form-control']) !!}
                </div>

                <!-- Message Form Input -->
                <div class="form-group">
                    {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
                    {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
                </div>

                @if($users->count() > 0)
                    <div class="checkbox">
                        @foreach($users as $user)
                            <label title="{!!$user->name!!}"><input type="checkbox" name="recipients[]" value="{!!$user->id!!}">{!!$user->name!!}</label>
                        @endforeach
                    </div>
                    @endif

                <!-- Submit Form Input -->
                <div class="form-group">
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop