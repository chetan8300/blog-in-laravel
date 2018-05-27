@extends('main')

@section('title', "| $tag->name Tag")

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            {!! Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => 'PUT']) !!}

            <h2>{{ Form::label('name', 'Edit Tag: ') }}</h2>
            {{ Form::text('name', null, array('class' => 'form-control', 'id' => 'focusedInput', 'autofocus' => 'autofocus' )) }}

            <br>
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('tags.show', 'Cancel', array($tag->id), array('class' => 'btn btn-default btn-block')) !!}
                </div>
                <div class="col-sm-6">
                    {{ Form::submit('Update', ['class' => 'btn btn-success btn-block']) }}
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection