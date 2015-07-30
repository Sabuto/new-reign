@extends('app')

@section('content')
    @include('partials.messages')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Travel to a new city</h3>
        </div>
        {!! Form::open(['route' => 'travelPost']) !!}
            <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Select</th>
                            </tr>
                        </thead>
                        <tbdoy>
                        @foreach($cities as $city)
                            <tr>
                                <td>{{$city->name}}</td>
                                <td>&pound;{{number_format($city->cost)}}</td>
                                <td>{!! Form::radio('city', $city->id) !!}</td>
                            </tr>
                        @endforeach
                        </tbdoy>
                    </table>
            </div>
            <div class="panel-footer text-center">
                    {!! Form::submit('Travel', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@stop