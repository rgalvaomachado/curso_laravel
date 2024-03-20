@extends('layouts.app')

@section('title','Listagem Usuarios')
@section('content')
    <h1>Listagem de usuarios</h1>
    <a href="{{route('users.create')}}">Criar</a>
    <form action="{{route('users.index')}}" method="get">
        <input type="text" name="search" placeholder="Pesquisar">
        <button type="submit">Pesquisar</button>
        <a href="{{route('users.index',"")}}">Todos</a>
    </form>
    @foreach ($users as $user)
        <li>
            {{$user->name}}
            {{$user->email}}
            {{-- Commentarios:{{count($user->comments()->get())}} --}}
            <a href="{{route('users.show',$user->id)}}">Detalhes</a>
            <a href="{{route('users.edit',$user->id)}}">Editar</a>
        </li>
    @endforeach
    {{-- {{$users->links()}} --}}
    {{
        $users->appends([
            'search' => request()->get('search','')
        ])->links()
    }}
@endsection