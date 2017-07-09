@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Inbox</div>
                <div class="panel-body">

                    @if(count($conversations))

                        @foreach($conversations as $date => $threads)
                            {{$date}}
                            @foreach($threads as $conversation)

                        <div class="alert alert-warning text-justify">
                            <a href="/conversation/{{ $conversation->id}}" >
                                @foreach($users as $user)
                                   @if($user->id == $conversation->id_to)
                                       {{ $user->name }}
                                       @elseif($user->id == $conversation->id_from)
                                        {{ $user->name }}
                                       @endif
                                @endforeach
                            </a>
                            <form action="/conversation/{{ $conversation->id }}" method="post">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                            <button class="btn btn-primary btn-danger pull-right" style="margin-top:-4%">Delete</button>
                            </form>
                        </div>
                                @endforeach
                            @endforeach
                        @else

                        <div class="text-center"> There is no message yet</div>
                        <br>
                    @endif
                        <div class="text-center">
                            <a href="/conversation/" class="btn btn-primary btn-default">New message</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
