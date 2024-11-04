@props(['post'])

<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                <p class="mb-0">{{$post->user->name}} <span class="text-muted">({{$post->user->email}})</span></p>
                @if($post->canEdit)
                    <a href="{{ route('posts.edit', $post) }}" class="mx-2">
                        <x-bi-pen-fill/>
                    </a>
                @endif
            </div>
            <div class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <x-bi-three-dots-vertical/>
                </a>

                @if($post->canReport)
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                data-bs-target="#reportModal-{{ $post->id }}">
                            Reportar
                        </button>
                    </div>
                @endif
            </div>
        </div>
        <p class="text-muted mb-0">{{ $post->created_at_formatted }}</p>
        <p class="text-muted">{{ $post->title }}</p>
        <hr/>
        <div class="card-text">
            {!! $post->body !!}
        </div>
        <hr>
        <p class="card-text mb-0"><strong>{{__('Place')}}:</strong> {{ $post->place }}</p>
        <p class="card-text mb-0"><strong>{{__('Published_At')}}
                :</strong> {{ $post->event_date_formatted }}</p>

        @if($post->canSubscribe)
            <form action="{{ route('posts.subscribe_user', $post) }}" method="POST"
                  class="d-inline action-form me-3">
                @csrf
                <button type="submit"
                        class="mt-2 btn btn-primary">
                    Deseo asistir
                </button>
            </form>
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
