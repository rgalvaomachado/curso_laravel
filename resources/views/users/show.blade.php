@extends('layouts.app')

@section('title','Listagem Usuario')
@section('content')
    <h1>Usuario</h1>
    <ul>
        <li>
            Nome: {{$user->name}}
        </li>
        <li>
            <a href="{{route('users.comments.index',$user->id)}}">Comentarios</a>
        </li>
        <li>
            <form action="{{route('users.delete',$user->id)}}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit">Deletar</button>
            </form>
        </li>
    </ul>
    
    
    <a href="{{route('users.index')}}">Voltar</a>
@endsection