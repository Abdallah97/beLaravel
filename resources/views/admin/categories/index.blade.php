@extends('layouts.admin')

@section('content')
    <h1>Categories</h1>

    <div class="col-sm-5">
        {!! Form::open() !!}
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
                        <td>{{$category->name}}</td>
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