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
        @foreach($conversation->messages as $message)
            @if($message->name == auth()->user()->name)
                <b>{{ $message->name }}</b> <div class="pull-right">{{ Carbon\Carbon::parse($message->created_at)->format('Y m d (H:m)') }}</div>
                <div class="alert alert-info" style="border: dotted 1px">
                    {{ $message->message }}
                </div>
            @else
                <b>{{ $message->name }}</b>  <div class="pull-right">{{ $message->created_at }}</div>
                <div class="alert alert-warning" style="border: dotted 1px">
                    {{ $message->message  }}
                </div>
            @endif
        @endforeach
        <form method="post" action="/message/{{ $conversation->id }}">
            {{ csrf_field() }}
            <div class="form-group">
                <textarea class="form-control" placeholder="Write your message here" rows="5" id="message" name="message" required></textarea>
                <input type="hidden" name="conv_id" value="{{ $conversation->id }}">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Send">
            </div>
        </form>
    </div>
    <br>
@endsection
