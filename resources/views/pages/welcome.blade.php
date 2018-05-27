@extends('main')

@section('title', '| Homepage')
        @section('content')
            <div class="row">
                <div class="col-md-12">
                    <div class="jumbotron">
                        <h1>Welcome to the Blog</h1>
                        <p class="lead">
                            Thankyou for visiting
                        </p>
                        <p>
                            <a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a>
                        </p>
                    </div>
                </div>
            </div> <!--End of row-->
            <div class="container">
                <div class="row">
                    <div class="col-md-8">

                        @foreach($posts as $post)

                            <div class="post">
                                <h3>{{ $post->title }}</h3>

                                <p>{{ substr(strip_tags($post->body), 0, 200) }}{{ strlen(strip_tags($post->body)) > 200?'...':'' }}</p>

                                <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary">Read More</a>
                            </div>
                            <br>
                            <p>
                                @if($post->tags->count() != 0)
                                    Tags:
                                @endif
                                @foreach($post->tags as $tag)
                                    <span class="label label-default">{{ $tag->name }}</span>
                                @endforeach
                            </p>

                        <hr>

                        @endforeach

                    </div>
                    <div class="col-md-3 col-md-offset-1">
                        <h2>Sidebar</h2>
                    </div>
                </div>
            </div>
            @endsection
