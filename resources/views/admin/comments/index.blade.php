@extends('layouts.admin')

@section('content')
    @if(Session::has('delete_comment'))
        <h2 class="text-center bg-success">
            <strong>{{session('delete_comment')}}</strong>
        </h2>
    @endif

    @if(count($comments) > 0)
        <h1>Comments</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Post Title</th>
                    <th>Comment Author</th>
                    <th>Content</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Display Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td>{{$comment->id}}</td>
                        <td><a href="{{route('home.post', $comment->post_id)}}">{{$comment->post->title}}</a></td>
                        <td>{{$comment->author}}</td>
                        <td>{{$comment->content}}</td>
                        <td>
                            {{$comment->created_at}}<br>
                            <small>({{$comment->created_at->diffForHumans()}})</small>
                        </td>
                        <td>
                            {{$comment->updated_at}}
                            <small>({{$comment->updated_at->diffForHumans()}})</small>
                        </td>
                        <td>{{$comment->is_active}}</td>
                        <td>
                            @if($comment->is_active === 'Displayed')
                                {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
                                <input type="hidden" name="is_active" value="0">

                                <div class="form-group">
                                    {!! Form::submit('Hide', ['class'=>'btn btn-warning']) !!}
                                </div>
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
                                <input type="hidden" name="is_active" value="1">

                                <div class="form-group">
                                    {!! Form::submit('Show', ['class'=>'btn btn-success']) !!}
                                </div>
                                {!! Form::close() !!}
                            @endif

                            {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id]]) !!}
                                <div class="form-group">
                                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                                </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h2 class="text-center">* There's no comment available yet *</h2>
    @endif
@stop