@extends('layouts.app')


@section('content')
    <h1>Edit Your Listing</h1>

    {!! Form::open(['action'=>['PostsController@update',$post->id],'method'=>'POST']) !!}
    <!-- Title Form -->
    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title',$post->title,['class'=>'form-control','placeholder'=>'What are you giving away?'])}}
    </div>
    <!-- Body Form -->
    <div class="form-group">
        {{Form::label('body','Body')}}
        {{Form::textarea('body',$post->body,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Describe your item'])}}
    </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Post',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection

