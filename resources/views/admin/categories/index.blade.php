@extends('layouts.admin')

@section('content')
    @if(Session::has('deleted_category'))
        <h4 class="bg-danger text-center"><strong>{{session('deleted_category')}}</strong></h4>
    @endif

    <h1>Categories</h1>

    <div class="col-sm-5">
        {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
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
            @if($categories)
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td><a href="{{route('admin.categories.edit', $category->id)}}">{{$category->name}}</a></td>
                        <td class="text-center">
                            {{$category->created_at}} <br>
                            <small>
                                ({{$category->created_at->diffForHumans()}})
                            </small>
                        </td>
                        <td class="text-center">
                            {{$category->updated_at}} <br>
                            <small>
                                ({{$category->updated_at->diffForHumans()}})
                            </small>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@stop