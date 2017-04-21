@extends('layouts.blog-post')

@section('title')
    {{$post->title}}
@stop

@section('content')
    @if(Session::has('comment_flash'))
        <h3 class="bg-success text-center">
            {{session('comment_flash')}}
        </h3>
    @endif

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->format('F j, Y')}} at {{$post->created_at->format('g:s A')}}</p>
    <p><small>({{$post->created_at->diffForHumans()}})</small></p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo->path}}" alt="">

    <hr>

    <!-- Post Content -->
    <p>{{$post->content}}</p>

    <hr>

    <!-- Blog Comments -->

    @if(Auth::check())
    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>

        {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}
        <input type="hidden" name="post_id" value="{{$post->id}}">

        <div class="form-group">
            {!! Form::textarea('content', null, ['class'=>'form-control', 'rows'=>3]) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Post Comment', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
    @endif

    <hr>

    <!-- Posted Comments -->

    @if(count($comments) > 0)
    <!-- Comment -->
        @foreach($comments as $comment)
            <div class="media">
                <a class="pull-left" href="#">
                    <img height="80" class="media-object" src="{{$comment->post->user->photo->path}}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->author}}
                        <small>
                            {{$comment->created_at->add(new DateInterval('PT7H'))->format('F j, Y')}}
                            at {{$comment->created_at->add(new DateInterval('PT7H'))->format('g:i A')}}
                        </small>
                    </h4>

                    <p>
                        {{$comment->content}}
                    </p>
                </div>
            </div>
        @endforeach
    @endif

    {{--<!-- Comment -->--}}
    {{--<div class="media">--}}
        {{--<a class="pull-left" href="#">--}}
            {{--<img class="media-object" src="http://placehold.it/64x64" alt="">--}}
        {{--</a>--}}
        {{--<div class="media-body">--}}
            {{--<h4 class="media-heading">Start Bootstrap--}}
                {{--<small>August 25, 2014 at 9:30 PM</small>--}}
            {{--</h4>--}}
            {{--Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.--}}
            {{--<!-- Nested Comment -->--}}
            {{--<div class="media">--}}
                {{--<a class="pull-left" href="#">--}}
                    {{--<img class="media-object" src="http://placehold.it/64x64" alt="">--}}
                {{--</a>--}}
                {{--<div class="media-body">--}}
                    {{--<h4 class="media-heading">Nested Start Bootstrap--}}
                        {{--<small>August 25, 2014 at 9:30 PM</small>--}}
                    {{--</h4>--}}
                    {{--Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!-- End Nested Comment -->--}}
        {{--</div>--}}
    {{--</div>--}}

@stop