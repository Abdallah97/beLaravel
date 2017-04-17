@extends('layouts.admin')

@section('content')
    @if(Session::has('deleted_post'))
        <p class="bg-danger text-center">{{session('deleted_post')}}</p>
    @endif

    <h1>Posts</h1>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Writer</th>
            <th>Category</th>
            <th>Title</th>
            <th width="25%">Content</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>
        </thead>
        <tbody>
        @if($posts)
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td><img height="80" src="{{$post->photo->path or '/images/300px-No_image_available.svg.png'}}" alt=""></td>
                    <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->user->name}}</a></td>
                    <td>{{$post->category->name or 'No category yet'}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->content}}</td>
                    <td>
                        {{$post->created_at}}<br>
                        <small>({{$post->created_at->diffForHumans()}})</small>
                    </td>
                    <td>
                        {{$post->updated_at}}<br>
                        <small>({{$post->updated_at->diffForHumans()}})</small>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@stop