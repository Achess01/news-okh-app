@php
    $columns = [
        'title' => 'Título',
        'status' => 'Estado',
        'created_at' => 'Fecha de publicación',
    ];

    $actions = [
        ['route' => 'posts.edit', 'label' => 'Editar', 'class' => 'warning'],
        ['route' => 'posts.destroy', 'label' => 'Eliminar', 'class' => 'danger', 'confirm' => true, 'method' => 'DELETE']
    ];
@endphp


@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Mis publicaciones</h3>
        <a href="{{route('posts.create')}}" class="btn btn-outline-primary my-3">Agregar publicación</a>
        <div class="row align-items-center justify-content-start">
            <div class="col-12 col-md-10 ">
                <x-paginated-table :items="$posts" :columns="$columns" :actions="$actions" />
            </div>
        </div>
    </div>
@endsection
