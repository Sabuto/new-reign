@extends('app')

@section('content')
    @include('partials.messages')
    <div class="panel panel-info">
        <div class="panel-heading">Current Vehicle</div>
        <div class="panel-body">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Units</th>
                    <th>Travel Time</th>
                </tr>
                <tr>
                    <td>{{$currentVehicle->name}}</td>
                    <td>&pound;{{number_format($currentVehicle->price)}}</td>
                    <td>{{$currentVehicle->units}}</td>
                    <td>{{$currentVehicle->travel_time}}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Buy a new vehicle</h3>
        </div>
        {!! Form::open(['route' => 'vehiclePost']) !!}
        <div class="panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Units</th>
                    <th>Travel Time</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbdoy>
                    @foreach($vehicles as $vehicle)
                        <tr>
                            <td>{{$vehicle->name}}</td>
                            <td>&pound;{{number_format($vehicle->price)}}</td>
                            <td>{{number_format($vehicle->units)}}</td>
                            <td>{{$vehicle->travel_time}}</td>
                            <td>{!! Form::radio('vehicle', $vehicle->id) !!}</td>
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