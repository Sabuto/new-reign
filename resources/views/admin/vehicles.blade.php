@extends('app')

@section('content')
    <table class="table">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Rank</th>
        </tr>
            <?php $a = 0; ?>
            @foreach($veh as $vehicle)
                <?php $a++; ?>
                <tr>
                    <td>{{$a}}</td>
                    <td>{{$vehicle->name}}</td>
                    <td>{{$vehicle->rank->name}}</td>
                </tr>
        @endforeach
    </table>
@stop