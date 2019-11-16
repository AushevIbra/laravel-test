<?php
/**
 * @var \App\Models\Message[] $messages
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        @auth()
            <button class="btn btn-primary add-message">Add Message</button>
        @endauth
        <div class="row justify-content-center">
            @foreach($messages as $message)
                <div class="col-md-12 m-1">
                    <div class="card">
                        <div class="card-header">{{$message->user->name}}</div>

                        <div class="card-body">
                            <img src="{{$message->img}}" class="img-thumbnail"> <br>
                            {{$message->text}}
                        </div>

                        @auth()
                            <div class="card-footer">
                                <button class="btn btn-outline-primary add-message" data-id="{{$message->id}}">Reply
                                </button>
                            </div>
                        @endauth
                    </div>
                </div>

                @foreach($message->messages as $childMessage)
                    <div class="col-md-11 offset-1 m-2">
                        <div class="card">
                            <div class="card-header">{{$childMessage->user->name}}</div>

                            <div class="card-body">
                                <img src="{{$childMessage->img}}" class="img-thumbnail"> <br>
                                {{$childMessage->text}}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
            {{$messages->links()}}

        </div>
    </div>


    <div id="modal"></div>
@endsection
