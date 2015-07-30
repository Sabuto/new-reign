@extends('app')

@section('content')
    @include('partials.messages')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-title">Update a news Item</div>
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => ['news.update', $news->id], 'method' => 'put']) !!}
            <!-- Title Form Input -->
            <div class="form-group">
                {!! Form::label('title', 'Title:') !!}
                {!! Form::text('title', $news->title, ['class' => 'form-control']) !!}
            </div>
            <!-- News Form Input -->
            <div class="form-group">
                {!! Form::label('news', 'News:') !!}
                {!! Form::textarea('news', $news->text, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Update News', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop