@php
    $columns = [
        'title' => 'Título',
        'user_name' => 'Usuario',
        'created_at' => 'Fecha de creación',
    ];

    $actions = [
        ['route' => 'posts.show_reported', 'label' => 'Ver', 'class' => 'primary'],
    ];
@endphp


@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Publicaciones reportadas</h3>
        <div class="row align-items-center justify-content-start">
            <div class="col-12 col-md-10 ">
                <x-paginated-table :items="$posts" :columns="$columns" :actions="$actions" />
            </div>
        </div>
    </div>
@endsection
