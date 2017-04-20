@extends('layouts.admin')

@section('content')
    @if(count($comments) > 0)
        <h1>Comments</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Post Title</th>
                    <th>Comment Author</th>
                    <th>Content</th>
                    <th>Display Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>

            <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td>{{$comment->id}}</td>
                        <td><a href="{{route('home.post', $comment->post_id)}}">{{$comment->post->title}}</a></td>
                        <td>{{$comment->author}}</td>
                        <td>{{$comment->content}}</td>
                        <td>{{$comment->is_active}}</td>
                        <td>
                            {{$comment->created_at}}<br>
                            <small>({{$comment->created_at->diffForHumans()}})</small>
                        </td>
                        <td>
                            {{$comment->updated_at}}
                            <small>({{$comment->updated_at->diffForHumans()}})</small>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h2 class="text-center">* There's no comment available yet *</h2>
    @endif
@stop