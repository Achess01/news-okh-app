@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">{{__('Posts')}}</h1>
                @foreach($posts as $post)
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="card-title">{{ $post->title }}</h2>
                            <p class="card-text"><strong>{{__('Place')}}:</strong> {{ $post->place }}</p>
                            <p class="card-text"><strong>{{__('Published_At')}}:</strong> {{ \Carbon\Carbon::parse($post->published_at)->format('d/m/Y H:i') }}</p>
                            <hr>
                            <div class="card-text">
                                {!! $post->content !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
