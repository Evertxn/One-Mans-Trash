@extends('layouts.app')


@section('content')
    <h1>Create Your Listing</h1>

    {!! Form::open(['action'=>'PostsController@store','method'=>'POST']) !!}
        <!-- Title Form -->
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title','',['class'=>'form-control','placeholder'=>'What are you giving away?'])}}
        </div>
        <!-- Body Form -->
        <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Describe your item'])}}
        </div>
        {{Form::submit('Post',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection

