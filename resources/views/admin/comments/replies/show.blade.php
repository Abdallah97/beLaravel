@extends('layouts.admin')

@section('content')
    <h1><a href="{{route('home.post', $comment->post_id)}}">Re: {{$comment->content}}</a></h1>

    @if(count($replies))
        <table class="table">
            <thead>
            <tr>
                <td>ID</td>
                <td>Author</td>
                <td>Contents</td>
                <td>Created At</td>
                <td>Updated At</td>
                <td>Display Status</td>
                <td>Action</td>
            </tr>
            </thead>

            <tbody>
            @foreach($replies as $reply)
                <tr>
                    <td>{{$reply->id}}</td>
                    <td>{{$reply->author}}</td>
                    <td>{{$reply->content}}</td>
                    <td>{{$reply->created_at}}</td>
                    <td>{{$reply->updated_at}}</td>
                    <td>{{$reply->is_active}}</td>
                    <td>
                        @if($reply->is_active === 'Displayed')
                            {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}
                            <input type="hidden" name="is_active" value="0">

                            <div class="form-group">
                                {!! Form::submit('Hide', ['class'=>'btn btn-warning']) !!}
                            </div>
                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}
                            <input type="hidden" name="is_active" value="1">

                            <div class="form-group">
                                {!! Form::submit('Show', ['class'=>'btn btn-success']) !!}
                            </div>
                            {!! Form::close() !!}
                        @endif

                        {!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy', $reply->id]]) !!}
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
        <h3 class="text-center">*There is no replies available for this comment (yet!)*</h3>
    @endif
@stop