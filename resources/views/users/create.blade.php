@extends('layouts.app')

@section('title','Novo Usuario')
@section('content')
    <h1>Novo Usuario</h1>
    @include('includes.validation-form')
    <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
        @include('users._partials.form')
    </form>
    <a href="{{route('users.index')}}">Voltar</a>
@endsection