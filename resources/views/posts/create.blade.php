@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Create New Post</h2>
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <!-- Title Input -->
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title') }}" required>
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Place Input -->
            <div class="mb-3">
                <label for="place" class="form-label">Lugar</label>
                <input type="text" name="place" id="place" class="form-control @error('place') is-invalid @enderror"
                       value="{{ old('place') }}" required>
                @error('place')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Content Textarea -->
            <div class="mb-3">
                <x-trix-input
                    id="body"
                    name="body"
                    class="form-control @error('body') is-invalid @enderror"
{{--                    :value="old('body', $post->body?->ToTrixHtml())"--}}
                    :value="old('body')"
                    required
                />

                @error('body')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="event_date" class="form-label">Event Date</label>
                <input type="datetime-local" name="event_date" id="event_date"
                       class="form-control @error('event_date') is-invalid @enderror" value="{{ old('event_date') }}"
                       required>
                @error('event_date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Crear post</button>
        </form>
    </div>
@endsection
