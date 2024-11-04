@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex mb-3 justify-content-start">
            <form action="{{ route('posts.accept_post', $post) }}" method="POST"
                  class="d-inline action-form me-3">
                @csrf
                <button type="submit"
                        class="btn btn-primary btn-sm">
                    Aceptar publicación
                </button>
            </form>


            <form action="{{ route('posts.reject_post', $post) }}" method="POST"
                  class="d-inline action-form">
                @csrf
                <button type="submit"
                        class="btn btn-danger btn-sm">
                    Rechazar publicación
                </button>
            </form>

        </div>
        <div class="row align-items-start justify-content-start">
            <div class="col-12 col-md-10">
                <x-post-card :post="$post"/>
            </div>
        </div>
    </div>
@endsection
