@extends('app')

@section('content')
    @include('partials.messages')
    <h3 class="page-heading">Hookers</h3>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title text-center">Current Hookers</h3>
        </div>
        <div class="panel-body">
            <table class="table table-responsive table-hover" id="ownedHookers">
                <thead>
                    <th>Name</th>
                    <th>Payout</th>
                    <th>Next Payout</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    @forelse($userHookers as $userHooker)
                        <tr data-delete="{{$userHooker->id}}">
                            <td>{{$userHooker->name}}</td>
                            <td>&pound;{{number_format($userHooker->payout)}}</td>
                            <td>{{$diff}}</td>
                            <td>
                                {!! Form::open(['url' => 'hookers/'.$userHooker->id, 'method' => 'delete']) !!}
                                        {!! Form::submit('Sell', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">You have not bought any hookers</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {!! Form::open(['action' => 'HookerController@buy', 'id' => 'hookerForm']) !!}
            <table class="table table-responsive table-hover">
                <thead>
                    <th>Name</th>
                    <th>Payout Per 24 Hours</th>
                    <th>Price to buy</th>
                    <th>Options</th>
                </thead>
                <tbody>
                @forelse($hookers as $hooker)
                    <tr data-row="{{$hooker->id}}">
                        <td>{{$hooker->name}}</td>
                        <td>&pound;{{number_format($hooker->payout)}}</td>
                        <td>&pound;{{number_format($hooker->price)}}</td>
                        <td>{!! Form::radio('hooker', $hooker->id) !!}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">There are no Hookers to Buy</td>
                    </tr>
                @endforelse
                    <tr>
                        <td colspan="4">{!! Form::submit('Buy Hooker', ['class' => 'btn btn-primary form-control', 'id' => 'submit']) !!}</td>
                    </tr>
                </tbody>
            </table>
            {!! Form::close() !!}
        </div>
    </div>
@stop