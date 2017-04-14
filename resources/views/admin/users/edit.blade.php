@extends('layouts.admin');

@section('content')
    <h1>Edit User</h1>

    <div class="row">
        <div class="col-sm-3">
            <img src="{{$user->photo->path or '/images/300px-No_image_available.svg.png'}}" alt="" class="img-responsive img-rounded">
        </div>

        <div class="col-sm-9">
            {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true]) !!}
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
                {!! Form::select('is_active', array(0 =>'Inactive', 1 => 'Active'), null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('image', 'Image: ') !!}
                {!! Form::file('image', null, ['class'=>'form-control']) !!}
            </div>


            <div class="form-group">
                {!! Form::submit('Update User', ['class'=>'btn btn-primary col-sm-4']) !!}
            {!! Form::close() !!}

            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy',$user->id]]) !!}
                {!! Form::submit('Delete User', ['class'=>'btn btn-danger col-sm-offset-4 col-sm-4']) !!}
            {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="row">
        @include('include.form-error')
    </div>
@stop