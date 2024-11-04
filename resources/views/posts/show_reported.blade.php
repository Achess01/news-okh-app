@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex mb-3 justify-content-start">
            <form action="{{ route('posts.accept_reports', $post) }}" method="POST"
                  class="d-inline action-form me-3">
                @csrf
                <button type="submit"
                        class="btn btn-primary btn-sm">
                    Aceptar reportes
                </button>
            </form>


            <form action="{{ route('posts.ignore_reports', $post) }}" method="POST"
                  class="d-inline action-form">
                @csrf
                <button type="submit"
                        class="btn btn-secondary btn-sm">
                    Ignorar reportes
                </button>
            </form>

        </div>
        <div class="row align-items-start justify-content-center">
            <div class="col">
                <h3 class="mb-3 text-muted">Reportes</h3>
                @forelse($post->reports as $report)
                    <div class="report">
                        <p><strong>Reportado por:</strong> {{ $report->user->name }} ({{$report->user->email}})</p>
                        <p><strong>Razón:</strong> {{ $report->reported_reason }}</p>
                        <p>{{ $report->reported_at_formatted }}</p>
                    </div>
                    <hr>
                @empty
                    <p>Sin reportes</p>
                @endforelse
            </div>
            <div class="col-12 col-md-7">
                <x-post-card :post="$post"/>
            </div>
        </div>
    </div>
@endsection
