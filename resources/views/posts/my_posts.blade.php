@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Mis publicaciones</h3>
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-md-8 ">
                {{--                <x-trix-input id="bio" name="bio" />--}}
                @foreach($posts as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </div>
            {{ $posts->links() }}
        </div>
    </div>
@endsection
