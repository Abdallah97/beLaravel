@extends('layouts.admin')

@section('content')
    <h1>Edit Category</h1>

    <div class="col-sm-5">
        <h4>Edited Category: {{$category->name}}</h4>

        {!! Form::model($category, ['method'=>'PATCH', 'action'=>['AdminCategoriesController@update', $category->id]]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Update Category', ['class'=>'btn btn-primary col-sm-5']) !!}
        {!! Form::close() !!}

        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy', $category->id]]) !!}
            {!! Form::submit('Delete Category', ['class'=>'btn btn-danger col-sm-offset-2 col-sm-5']) !!}
        {!! Form::close() !!}
        </div>
    </div>

    <div class="col-sm-7">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th class="text-center">Created At</th>
                <th class="text-center">Updated At</th>
            </tr>
            </thead>

            <tbody>
            @if($allCategories)
                @foreach($allCategories as $oneCategory)
                    <tr>
                        <td>{{$oneCategory->id}}</td>
                        <td><a href="{{route('admin.categories.edit', $oneCategory->id)}}">{{$oneCategory->name}}</a></td>
                        <td class="text-center">
                            {{$oneCategory->created_at}} <br>
                            <small>
                                ({{$oneCategory->created_at->diffForHumans()}})
                            </small>
                        </td>
                        <td class="text-center">
                            {{$oneCategory->updated_at}} <br>
                            <small>
                                ({{$oneCategory->updated_at->diffForHumans()}})
                            </small>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@stop