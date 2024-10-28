@props(['post'])

<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex">
            <div>{{$post->user->name}} <span class="text-muted">({{$post->user->email}})</span></div>
            @if($post->canEdit)
                <a href="" class="mx-2">
                    <x-bi-pen-fill/>
                </a>
            @endif
        </div>
        <hr />
        <div class="card-text">
            {!! $post->content !!}
        </div>
        <hr>
        <p class="card-text"><strong>{{__('Place')}}:</strong> {{ $post->place }}</p>
        <p class="card-text"><strong>{{__('Published_At')}}
                :</strong> {{ \Carbon\Carbon::parse($post->published_at)->format('d/m/Y H:i') }}</p>
        @if($post->canReport)
            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#reportModal-{{ $post->id }}">
                Reportar
            </button>
        @endif

        <!-- Modal -->
        <div class="modal fade" id="reportModal-{{ $post->id }}" tabindex="-1"
             aria-labelledby="reportModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reportModalLabel">Reportar Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario de reporte -->
                        <form action="{{ route('posts.report', $post->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="reported_reason" class="form-label">Razón del
                                    reporte</label>
                                <textarea class="form-control" id="reported_reason"
                                          name="reported_reason" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar Reporte</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
