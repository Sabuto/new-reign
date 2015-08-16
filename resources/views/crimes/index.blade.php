@extends('app')

@section('content')
    @include('partials.messages')
    @if($timer->crimeTime > \Carbon\Carbon::now())
        <div class="panel panel-primary">
            <div class="panel-body">
                <p>You must wait before comitting another crime</p>
                <p>You can do another crime in {{gmdate("i:s", \Carbon\Carbon::now()->diffInSeconds($timer->crimeTime))}}</p>
                <?php
                /*
                TODO: add js countdown timer
                */
                ?>
            </div>
        </div>
    @else
        {!! Form::open(['action' => 'CrimesController@doCrime']) !!}
        <table class="table">
            <tr>
                <th>Name</th>
                <th>&nbsp;</th>
                <th>Off</th>
                <th>Def</th>
                <th>Stl</th>
                <th>&nbsp;</th>
                <th>Options</th>
            </tr>
            <tr>
                @foreach($crimes as $crime)
                    <td>{{$crime->name}}</td>
                    <td>&nbsp;</td>
                    <td>{{$crime->off_shown}}%</td>
                    <td>{{$crime->def_shows}}%</td>
                    <td>{{$crime->stl_shown}}%</td>
                    <td>&nbsp;</td>
                    <td>
                        <input type="radio" name="crime" value="{{$crime->id}}">
                    </td>
                @endforeach
            </tr>
            <tr>
                <td colspan="7">
                    <div class="form-group">
                        {!! Form::submit('Commit Crime', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                </td>
            </tr>
        </table>
        {!! Form::close() !!}
    @endif
@stop

@section('scripts')
    <script src="{{asset('js/timer.js')}}"></script>
@stop