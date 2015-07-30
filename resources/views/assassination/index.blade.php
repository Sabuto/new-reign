@extends('app')

@section('content')
    @include('partials.messages')
    {!! Form::open(['route' => 'assassination.kill']) !!}
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Assassination</h3>
        </div>
        <div class="panel-body">
            <p>With Assassination, you will be given a random target, this is not an in-game player. You will be told where the target was last seen and how much he is worth killing.</p>
            <table class="table">
                <tr>
                    <td>Target</td>
                    <td>{{$target->assassination->name}}</td>
                </tr>
                <tr>
                    <td>Last Seen:</td>
                    <td>{{$target->assassination->city}}</td>
                </tr>
                <tr>
                    <td>Bounty:</td>
                    <td>&pound;{{number_format($target->assassination->bounty)}}</td>
                </tr>
            </table>
        </div>
        @if($target->city_id == $target->assassination->city)
            <div class="panel-footer text-center">
                    {!! Form::submit('Attempt to Kill', ['class' => 'btn btn-primary']) !!}
            </div>
        @endif
    </div>
    {!! Form::close() !!}
@stop