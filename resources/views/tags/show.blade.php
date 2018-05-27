@extends('main')

@section('title', "| $tag->name Tag")

@section('content')

    <div class="row">
        <div class="col-md-6">
            <h1>"{{ $tag->name }}" Tag &nbsp; <small>{{ $tag->posts()->count() }} {{ $tag->posts()->count()>1?'Posts':'Post' }}</small></h1>
        </div>
        <div class="col-md-2 see-all-post-top">
            <a href="{{ route('tags.index') }}" class="btn btn-primary btn-block btn-lg">View All Tags</a>
        </div>
        <div class="col-md-2 see-all-post-top">
            <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary btn-block btn-lg">Edit</a>
        </div>
        <div class="col-md-2 see-all-post-top">
            {!! Form::open(array( 'route' => ['tags.destroy', $tag->id], 'method'=> 'DELETE')) !!}

            {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-block btn-lg')) !!}

            {!! Form::close() !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Title</th>
                    <th>Tags</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    @foreach( $tag->posts as $post )
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $post->title }}</td>
                            <td>
                                @foreach($post->tags as $tag)
                                    <span class="label label-default"><a href="{{ route('tags.show', $tag->id) }}" class="no-a-color">{{ $tag->name }}</a></span>
                                @endforeach
                            </td>
                            <td><a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-sm">View</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>






@endsection
