@extends('layouts.admin')

@section('content')
    <h1>Edit Post</h1>

    <div class="row">
        <div class="col-sm-3">
            <img src="{{$post->photo->path or '/images/300px-No_image_available.svg.png'}}" alt="" class="img-responsive img-rounded">
        </div>

        <div class="col-sm-9">
            {!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPostsController@update', $post->id], 'files'=>true]) !!}

            <div class="form-group">
                {!! Form::label('title', 'Title: ') !!}
                {!! Form::text('title', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('category_id', 'Categories: ') !!}
                {!! Form::select('category_id', [''=>'Choose a category..'] + $categories, null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('content', 'Content: ') !!}
                {!! Form::textarea('content', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('photo_id', 'Image: ') !!}
                {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update Post', ['class'=>'btn btn-primary col-sm-4']) !!}
            {!! Form::close() !!}

            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id]]) !!}
                {!! Form::submit('Delete Post', ['class'=>'btn btn-danger col-sm-offset-4 col-sm-4']) !!}
            {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="row">
        @include('include.form-error')
    </div>
@stop