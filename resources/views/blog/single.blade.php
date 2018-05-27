@extends('main')

<?php $title = htmlspecialchars($post->title); ?>

@section('title', "| $title ")

@section('content')


    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-8 col-md-offset-2">
            <img src="{{ asset('images/'. $post->image) }}">
            <h1>{{ $post->title }}</h1>
            <hr>
            <p>{!! $post->body !!}</p>
            <hr>
            <p>Posted In: {{ $post->category->name }}</p>

            <hr>

            <p>
                Tags:
                @foreach($post->tags as $tag)
                    <span class="label label-default">{{ $tag->name }}</span>
                @endforeach
            </p>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3 class="comment-title"><span class="glyphicon glyphicon-comment"></span> {{ $post->comments()->count() }} Comments and Responses: </h3>
            @foreach($post->comments as $comment)
                <div class="comment">
                    <div class="author-info">
                        <img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) }}" class="author-image1">
                        <div class="author-name">
                            <h4>{{ $comment->name }}</h4>
                            <div class="author-time">{{ date('M j, Y h:ia',strtotime($comment->created_at)) }}</div>
                        </div>
                    </div>
                    <div class="comment-content">{{ $comment->comment }}</div><br>
                </div>
            @endforeach
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            {!! Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST', 'data-parsley-validate' => '']) !!}

            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <br>
                    {{ Form::label('name', 'Name: ') }}
                    {{ Form::text('name', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255')) }}

                    <br>
                    {{ Form::label('email', 'Email Address: ') }}
                    {{ Form::email('email', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255')) }}

                    <br>
                    {{ Form::label('comment', 'Comment: ') }}
                    {{ Form::textarea('comment', null, array('class' => 'form-control', 'required' => '', 'rows' => '5')) }}

                    {{ Form::submit("Add Comment", array("class" => "btn btn-success btn-lg btn-block", "style" => "margin-top: 20px;")) }}
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection
