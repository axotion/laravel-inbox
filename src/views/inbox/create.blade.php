@extends('layouts.app')

@section('content')

    <div class="container" style="margin-top: 3%">
        <div class="container">
            @if(count($errors))
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger text-center">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
        </div>
        <form method="post" action="/conversation">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="formGroupExampleInput">To:</label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Username" name="user" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Subject" name="subject" required>
            </div>
            <div class="form-group">
                <textarea class="form-control" placeholder="Write your message here" rows="5" id="message" name="message" required></textarea>
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Send">
            </div>
        </form>
    </div>

@endsection
