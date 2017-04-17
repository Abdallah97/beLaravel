@extends('layouts.admin')

@section('content')
    <h1>Create User</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store', 'files'=>true]) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name: ') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email: ') !!}
        {!! Form::email('email', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Password: ') !!}
        {!! Form::password('password', ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('role_id', 'Role: ') !!}
        {!! Form::select('role_id', [''=>'Choose a role..'] + $roles, null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('is_active', 'Status: ') !!}
        {!! Form::select('is_active', array(0 =>'Inactive', 1 => 'Active'), 0, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('image', 'Image: ') !!}
        {!! Form::file('image', ['class'=>'form-control']) !!}
    </div>


    <div class="form-group">
        {!! Form::submit('Create User', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

    {{--Showing errors using include instead--}}
    {{--@if(count($errors) > 0)--}}
        {{--@foreach($errors->all() as $error)--}}
            {{--<div class="alert alert-danger">--}}
                {{--{{$error}}--}}
            {{--</div>--}}
        {{--@endforeach--}}
    {{--@endif--}}
    @include('include.form-error')
@stop