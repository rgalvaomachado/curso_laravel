@extends('layouts.app')

@section('title','Novo Usuario')
@section('content')
    <h1>Novo Comentario para {{$user->name}}</h1>
    @include('includes.validation-form')
    <form action="{{route('users.comments.store',$user->id)}}" method="POST">
        @csrf
        <textarea type="text" name="body" placeholder="body"></textarea>
        <br>
        Visible
        <input type="checkbox" name="visible">
        <br>
        <button type="submit">Salvar</button>
    </form>
@endsection