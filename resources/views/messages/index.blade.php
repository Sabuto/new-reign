@extends('app')

@section('content')
    @if (Session::has('error_message'))
        <div class="alert alert-danger" role="alert">
            {!! Session::get('error_message') !!}
        </div>
    @endif
    @if($threads->count() > 0)
        @foreach($threads as $thread)
            <?php $class = $thread->isUnread($currentUserId) ? 'panel-info' : 'panel-primary'; ?>
            <div id="thread_list_{{$thread->id}}" class="panel {!!$class!!}">
                <div class="panel-heading">
                    <h4 class="panel-title">{!! link_to('messages/' . $thread->id, $thread->subject) !!}</h4>
                </div>

                <div class="panel-body">
                    <p id="thread_list_{{$thread->id}}_text">{!! $thread->latestMessage->body !!}</p>
                    <p><small><strong>Creator:</strong> {!! $thread->creator()->name !!}</small></p>
                    <p><small><strong>Participants:</strong> {!! $thread->participantsString(Auth::id()) !!}</small></p>
                </div>
            </div>
        @endforeach
    @else
        <div class="panel panel-primary">
            <div class="panel-body">
                <p>Sorry, no threads.</p>
            </div>
        </div>
    @endif
@stop