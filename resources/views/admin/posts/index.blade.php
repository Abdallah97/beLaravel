@extends('layouts.admin')

@section('content')
    <h1>Posts</h1>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Writer</th>
            <th>Title</th>
            <th>Content</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>
        </thead>
        <tbody>
        @if($posts)
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->user->name}}</td>
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