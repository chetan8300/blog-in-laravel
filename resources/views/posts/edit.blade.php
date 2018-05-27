@extends('main')

@section('title', '| Edit Blog Post')

@section('stylesheets')
    {!! Html::style('css/select2.min.css') !!}
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=mh5v8gff6k2mj1turw5jor40ok93i39lqms54q8p9sitiwqa"></script>
    <script>
        tinymce.init({
            selector:'textarea',
            plugins: "link,wordcount,code",
        });
    </script>
@endsection

@section('content')

    <div class="row">
        {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'files' => true]) !!}
        <div class="col-md-8 col-sm-4">

            {{ Form::label('title', 'Title: ') }}
            {{ Form::text('title', null, array('class' => 'form-control', 'id' => 'focusedInput', 'autofocus' => 'autofocus' )) }}

            {{ Form::label('category', 'Category: ', ['class' => 'form-spacing-top']) }}
            {{ Form::select('category_id', $categories, null, array('class' => 'form-control' )) }}

            {{ Form::label('tags', 'Tags: ', ['class' => 'form-spacing-top']) }}
            {{ Form::select('tags[]', $tags, null, array('class' => 'form-control select2-multi', 'multiple' => 'multiple')) }}

            {{ Form::label('slug', 'Slug: ', ['class' => 'form-spacing-top']) }}
            {{ Form::text('slug', null, array('class' => 'form-control' )) }}

            {{ Form::label('featured_image', 'Update Featured Image: ', ['class' => 'form-spacing-top']) }}
            {{ Form::file('featured_image') }}

            {{ Form::label('body', 'Post Body: ', ['class' => 'form-spacing-top']) }}
            {{ Form::textarea('body', null, array('class' => 'form-control' )) }}

        </div>

        <div class="col-md-4 col-sm-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <dt>Created At:</dt>
                    <dd>{{ date('M j, Y h:ia',strtotime($post->created_at)) }}</dd>
                </dl>

                <dl class="dl-horizontal">
                    <dt>Updated At:</dt>
                    <dd>{{ date('M j, Y h:ia',strtotime($post->updated_at)) }}</dd>
                </dl>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        {!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-de
                        fault btn-block')) !!}
                    </div>
                    <div class="col-sm-6">
                        {{ Form::submit('Update', ['class' => 'btn btn-success btn-block']) }}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@endsection

@section('scripts')
    {!! Html::script('js/select2.min.js') !!}

    <script>
        $(document).ready(function() {
            $('.select2-multi').select2();
        });
    </script>

@endsection