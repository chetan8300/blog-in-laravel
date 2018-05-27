@extends('main')

@section('title', '| All Tags')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>Tags</h1>
            <table class="table">

                <thead>
                    <th>#</th>
                    <th>Tag</th>
                    <th>Created At</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>

                <tbody>
                    <?php $i=1; ?>
                    @foreach($tags as $tag)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
                            <td>{{ date('M j, Y h:ia',strtotime($tag->created_at)) }}</td>
                            <td>{!! Html::linkRoute('tags.edit', 'Edit', array($tag->id), array('class' => 'btn btn-primary')) !!}</td>
                            <td>{!! Html::linkRoute('tags.destroy', 'Delete', array($tag->id), array('class' => 'btn btn-danger')) !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="col-md-4">
            <div class="well">
                {!! Form::open(['route' => 'tags.store']) !!}

                    <h2>Create New Tag: </h2>
                    {{ Form::label('name', 'Tag Name: ') }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'focusedInput', 'autofocus' => 'autofocus']) }}

                    <br>
                    {{ Form::submit('Add Category', ['class' => 'btn btn-success btn-block']) }}

                {!! Form::close() !!}
            </div>
        </div>

    </div>

@endsection