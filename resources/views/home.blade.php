@extends('layouts.app')

@section('titulo')
Páginal Principal
@endsection

@section('contenido')

    <x-listar-post :posts="$posts" />
    
@endsection