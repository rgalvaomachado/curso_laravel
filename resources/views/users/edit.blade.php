@extends('layouts.app')

@section('title','Editar Usuario')
@section('content')
    <h1>Editar {{$user->name}}</h1>
    @include('includes.validation-form')
    <form action="{{route('users.update',$user->id)}}" method="POST">
        @method('PUT')
        {{-- <input type="hidden" name="_method" value="PUT"> --}}
        @csrf
        {{-- {{ csrf_token() }} --}}
        @include('users._partials.form')
    </form>
    <a href="{{route('users.index')}}">Voltar</a>
@endsection