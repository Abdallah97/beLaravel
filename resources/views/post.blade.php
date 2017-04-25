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

    @if(Session::has('reply_flash'))
        <h3 class="bg-success text-center">
            {{session('reply_flash')}}
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

    <hr>

    @if($post->photo)
        <img class="img-responsive" src="{{$post->photo->path}}" alt="">
    @endif

    <!-- Post Content -->
    <p><strong>{{$post->category->name or ''}}</strong></p>
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
                    <img height="64" class="media-object" src="{{$comment->image}}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->author}}
                        <small>
                            {{$comment->created_at->add(new DateInterval('PT7H'))->format('F j, Y')}}
                            at {{$comment->created_at->add(new DateInterval('PT7H'))->format('g:i A')}}
                            ({{$comment->created_at->diffForHumans()}})
                        </small>
                    </h4>

                    <p class="primary-comment">
                        {{$comment->content}}
                    </p>

                    {{--REPLIES--}}
                    @if(count($comment->replies) > 0)

                        @foreach($comment->replies as $reply)
                            <div class="media nested-comment">
                                <a class="pull-left" href="#">
                                    <img height="44" class="media-object" src="{{ $reply->image or asset('images/300px-No_image_available.svg.png') }}" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        {{$reply->author}}

                                        <small>
                                            {{$reply->created_at->add(new DateInterval('PT7H'))->format('F j, Y')}}
                                            at {{$reply->created_at->add(new DateInterval('PT7H'))->format('g:i A')}}
                                            ({{$reply->created_at->diffForHumans()}})
                                        </small>
                                    </h4>

                                    <p>
                                        {{$reply->content}}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                    @endif
                    {{--END OF REPLIES--}}

                    <div class="comment-reply-container">
                        <button class="btn btn-primary pull-right toggle-reply">Reply</button>

                        <div class="comment-reply col-xs-10">
                            {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}
                            <input type="hidden" name="comment_id" value="{{$comment->id}}">

                            <div class="form-group">
                                {!! Form::textarea('content', null, ['class'=>'form-control', 'rows'=>3]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
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

@section('scripts')
    <script>
        $(".comment-reply-container .toggle-reply").click(function () {
           $(this).next().slideToggle("slow");
        });
    </script>
@stop