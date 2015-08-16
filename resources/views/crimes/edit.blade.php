@extends('app')

@section('content')
    @include('partials.messages')
    <h3 class="page-heading">Edit a crime</h3>
    {!! Form::open(['route' => ['crimes.update', $crime->id], 'method' => 'put']) !!}

        <div class="row">
            <div class="col-md-12">
                <!-- Name Form Input -->
                <div class="form-group">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name', $crime->name, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="line"></div>

        <div class="row">
            <div class="col-md-6">
                <!-- Offence Shown Form Input -->
                <div class="form-group">
                    {!! Form::label('off_shown', 'Offence Shown: (%)') !!}
                    {!! Form::number('off_shown', $crime->off_shown, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <!-- Real Offence Form Input -->
                <div class="form-group">
                    {!! Form::label('off_real', 'Real Offence:') !!}
                    {!! Form::number('off_real', $crime->off_real, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <!-- Defence Shown Form Input -->
                <div class="form-group">
                    {!! Form::label('def_shown', 'Defence Shown: (%)') !!}
                    {!! Form::number('def_shown', $crime->def_shown, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <!-- Real Defence Form Input -->
                <div class="form-group">
                    {!! Form::label('def_real', 'Real Defence:') !!}
                    {!! Form::number('def_real', $crime->def_real, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <!-- Stealth Shown Form Input -->
                <div class="form-group">
                    {!! Form::label('stl_shown', 'Stealth Shown: (%)') !!}
                    {!! Form::number('stl_shown', $crime->stl_shown, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <!-- Real Stealth Form Input -->
                <div class="form-group">
                    {!! Form::label('stl_real', 'Real Stealth:') !!}
                    {!! Form::number('stl_real', $crime->stl_real, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="line"></div>

        <div class="row">
            <div class="col-md-6">
                <!-- Points Needed Form Input -->
                <div class="form-group">
                    {!! Form::label('points_needed', 'Points Needed:') !!}
                    {!! Form::number('points_needed', $crime->points_needed, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <!-- Points Gained Form Input -->
                <div class="form-group">
                    {!! Form::label('points', 'Points Gained:') !!}
                    {!! Form::number('points', $crime->points, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- City Form Input -->
                <div class="form-group">
                    {!! Form::label('city', 'City:') !!}
                    <select name="city" class="form-control" required>
                        @foreach($cities as $city)

                            <option value="{{$city->id}}" @if($city->id == $crime->city_id) selected @endif>{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="line"></div>

    <div class="row">
        <div class="col-md-4">
            <!-- Success Message Form Input -->
            <div class="form-group">
                {!! Form::label('success_message', 'Success Message:') !!}
                {!! Form::textarea('success_message', $crime->success_message, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <!-- Fail Message Form Input -->
            <div class="form-group">
                {!! Form::label('fail_message', 'Fail Message:') !!}
                {!! Form::textarea('fail_message', $crime->fail_message, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <!-- Jail Message Form Input -->
            <div class="form-group">
                {!! Form::label('jail_message', 'Jail Message:') !!}
                {!! Form::textarea('jail_message', $crime->jail_message, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="line"></div>

    <div class="row">
        <div class="col-md-6">
            <!-- Minimum Money Form Input -->
            <div class="form-group">
                {!! Form::label('min_money', 'Minimum Money:') !!}
                {!! Form::number('min_money', $crime->min_money, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <!-- Maximum Money Form Input -->
            <div class="form-group">
                {!! Form::label('max_money', 'Maximum Money:') !!}
                {!! Form::number('max_money', $crime->max_money, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="line"></div>

    <div class="row">
        <div class="col-md-6">
            <!-- Time user has to wait for next crime Form Input -->
            <div class="form-group">
                {!! Form::label('crime_timer', 'Time user has to wait for next crime:') !!}
                {!! Form::text('crime_timer', $crime->crime_timer, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <!-- The time the user will be in jail if they are busted Form Input -->
            <div class="form-group">
                {!! Form::label('jail_timer', 'The time the user will be in jail if they are busted:') !!}
                {!! Form::text('jail_timer', $crime->jail_timer, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="line"></div>
    <div class="form-group">
        {!! Form::submit('Edit Crime', ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}
@stop