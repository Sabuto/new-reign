<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">Post new news item</div>
    </div>
    <div class="panel-body">
        {!! Form::open(['route' => 'news.store']) !!}
        <!-- Title Form Input -->
        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>
        <!-- News Form Input -->
        <div class="form-group">
            {!! Form::label('news', 'News:') !!}
            {!! Form::textarea('news', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Post News', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>