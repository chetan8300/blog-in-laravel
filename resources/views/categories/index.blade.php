@extends('main')

@section('title', '| All Categories')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>Categories</h1>
            <table class="table">

                <thead>
                    <th>#</th>
                    <th>Category</th>
                    <th>Created At</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>

                <tbody>
                    <?php $i=1; ?>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ date('M j, Y h:ia',strtotime($category->created_at)) }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="col-md-4">
            <div class="well">
                {!! Form::open(['route' => 'categories.store']) !!}

                    <h2>Create New Category: </h2>
                    {{ Form::label('name', 'Category Name: ') }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'focusedInput', 'autofocus' => 'autofocus']) }}

                    <br>
                    {{ Form::submit('Add Category', ['class' => 'btn btn-success btn-block']) }}

                {!! Form::close() !!}
            </div>
        </div>

    </div>

@endsection