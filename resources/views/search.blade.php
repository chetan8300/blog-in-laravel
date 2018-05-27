@extends('main')

@section('title', '| Search')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Search Query: {{ $query }}</h2>
            <br>

            <h3>Results:</h3>
        </div>
        @foreach($results as $result)
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2><a href="{{ route('blog.single', $result->slug) }}">{{ $result->title }}</a></h2>
                    <h5>Published: {{ date('M j, Y', strtotime($result->created_at)) }}</h5>

                    <p>{{ substr(strip_tags($result->body), 0, 250) }}{{ strlen(strip_tags($result->body)) > 250 ? '...' : '' }}</p>

                    <p>
                        @if($result->tags->count() != 0)
                            Tags:
                        @endif
                        @foreach($result->tags as $tag)
                            <span class="label label-default">{{ $tag->name }}</span>
                        @endforeach
                    </p>

                    <a href="{{ route('blog.single', $result->id) }}" class="btn btn-primary btn-lg">Read More...</a>
                    <hr>
                </div>
            </div>
        @endforeach
    </div>
@endsection
