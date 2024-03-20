@extends('layouts.app')

@section('title','Novo Usuario')
@section('content')
    <h1>Editar Comentario para {{$user->name}}</h1>
    @include('includes.validation-form')
    <form action="{{route('users.comments.update',[
        'idUser' => $user->id,
        'id' => $comments->id,
        ])}}" method="POST">
        @method('PUT')
        @csrf
        <textarea type="text" name="body" placeholder="body">{{$comments->body}}</textarea>
        <br>
        Visible
        <input type="checkbox" name="visible" {{($comments->visible == 1 ? 'checked' : '')}}>
        <br>
        <button type="submit">Salvar</button>
    </form>
    <a href="{{route('users.comments.index',$user->id)}}">Voltar</a>
@endsection