@extends('app')

@section('content')

    @include('partials.messages')

    <h3 class="page-heading">News from Admins</h3>
    @forelse($news as $newsItem)
        <div class="panel panel-primary">
            <div class="panel-heading">
                @if($user->isAdmin() == 1)
                    {!! Form::open(['route' => ['news.destroy', $newsItem->id], 'method' => 'delete']) !!}
                        <button type="submit" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {!! Form::close() !!}
                    <a href="{{route('news.edit', $newsItem->id )}}" class="close pencil"><span class="glyphicon glyphicon-pencil"></span></a>
                @endif
                <div class="panel-title">{{$newsItem->title}}</div>
            </div>
            <div class="panel-body">
                {{$newsItem->text}}
            </div>
        </div>
    @empty
        <div class="panel-panel-primary">
            <div class="panel-body">
                There are no news items to display.
            </div>
        </div>
    @endforelse

    @if($user->isAdmin() == 1)
        @include('partials.news.create')
    @endif
@stop