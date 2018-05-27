@extends('main')

@section('title', '| Edit Comment')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <h2 class="text-center">Edit Comment</h2>

            {{ Form::model($comment, ['route' => ['comments.update', $comment->id], 'method' => 'PUT']) }}

            {{ Form::label('name', 'Name: ') }}
            {{ Form::text('name', null, ['class' => 'form-control', 'disabled' => 'disabled']) }}

            <br>
            {{ Form::label('email', 'Email: ') }}
            {{ Form::email('email', null, ['class' => 'form-control', 'disabled' => 'disabled']) }}

            <br>
            {{ Form::label('comment', 'Comment: ') }}
            {{ Form::textarea('comment', null, ['class' => 'form-control']) }}

            {{ Form::submit('Update Comment', ['class' => 'btn btn-block btn-success see-all-post-top']) }}

            {{ Form::close() }}

        </div>
    </div>

@endsection