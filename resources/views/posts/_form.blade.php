<form action="{{ $post?->exists ? route('posts.update', $post) : route('posts.store') }}" method="POST">
    @csrf

    @if($post?->exists ?? false)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="title" class="form-label">Título</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
               value="{{ old('title', $post?->title) }}" required>
        @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Place Input -->
    <div class="mb-3">
        <label for="place" class="form-label">Lugar</label>
        <input type="text" name="place" id="place" class="form-control @error('place') is-invalid @enderror"
               value="{{ old('place', $post?->place) }}" required>
        @error('place')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Content Textarea -->
    <div class="mb-3">
        <x-trix-input
            :id="$post?->exists ? 'post_'.$post->id.'_body' : 'create_post_body'"
            name="body"
            class="form-control @error('body') is-invalid @enderror"
            {{--                    :value="old('body', $post->body?->ToTrixHtml())"--}}
            :value="old('body', $post?->body)"
            required
        />

        @error('body')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="event_date" class="form-label">Event Date</label>
        <input type="datetime-local" name="event_date" id="event_date"
               class="form-control @error('event_date') is-invalid @enderror" value="{{ old('event_date', $post?->event_date) }}"
               required>
        @error('event_date')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">{{ $post?->exists ? 'Guardar' : 'Crear' }}</button>
</form>
