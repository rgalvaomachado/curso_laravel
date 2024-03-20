@extends('layouts.app')

@section('title','Listagem de comentarios')
@section('content')
    <h1>Listagem de comentarios do {{$user->name}}</h1>
    <a href="{{route('users.comments.create', $user->id)}}">Criar</a>
    {{-- <form action="{{route('users.comments.index', $user->id)}}" method="get">
        <input type="text" name="search" placeholder="Pesquisar">
        <button type="submit">Pesquisar</button>
        <a href="{{route('users.comments.index', $user->id)}}">Todos</a>
    </form> --}}
    @foreach ($comments as $comment)
        <li>
            {{$comment->body}}
            {{$comment->visible == 1 ? "Visivel" : "Não Visivel"}}
            <a href="{{route('users.comments.edit',[
             'idUser' => $user->id,
             'id' => $comment->id
            ])}}">Editar</a>
        </li>
    @endforeach
    <a href="{{route('users.show', $user->id)}}">Voltar</a>
@endsection