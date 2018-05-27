@extends('main')

@section('title', '| Contact us')

@section('content')
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1>Contact us</h1>
                    <hr>
                    <form action="{{ url('contact') }}" method="POST">

                        {{ csrf_field()  }}

                        <div class="form-group">
                            <label name="email">Email:</label>
                            <input type="email" name="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label name="subject">Subject:</label>
                            <input type="text" name="subject" class="form-control" id="subject">
                        </div>
                        <div class="form-group">
                            <label name="message">Message:</label>
                            <textarea id="message" name="message" class="form-control" rows="7" cols="50">Type Your Message Here....
                            </textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Send Message</button>
                    </form>
                </div>
            </div>
@endsection