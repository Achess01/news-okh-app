@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Notificaciones</h3>
        <div class="row align-items-center justify-content-start">
            @foreach ($posts as $notification)
                <div class="card p-3 mb-3">
                    <p>Fecha del evento: {{ $notification->event_date_formatted }}</p>
                    <p>Tiempo faltante:
                        @if (now()->greaterThan($notification->event_date))
                            0 días
                        @else
                            <span id="countdown-{{ $notification->id }}"></span>
                        @endif
                    </p>

                    <div class="d-flex">
                        <a href="{{ route('posts.show', $notification) }}" class="btn btn-primary me-3">Ver</a>
                        <form action="{{ route('posts.unsubscribe_user', $notification) }}" method="POST"
                              class="mb-0">
                            @csrf
                            <button type="submit" class="btn btn-danger">Quitar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Store each event date and countdown element
        const countdowns = [
                @foreach ($posts as $notification)
                @if (now()->lessThan($notification->event_date))
            {
                id: "{{ $notification->id }}",
                eventDate: new Date("{{ $notification->event_date }}"),
                element: document.getElementById("countdown-{{ $notification->id }}")
            },
            @endif
            @endforeach
        ];

        function updateCountdowns() {
            const now = new Date().getTime();

            countdowns.forEach(countdown => {
                const timeLeft = countdown.eventDate - now;

                if (timeLeft <= 0) {
                    countdown.element.innerHTML = "0 días, 0 horas, 0 minutos, 0 segundos";
                } else {
                    const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                    countdown.element.innerHTML = `${days} días, ${hours} horas, ${minutes} minutos, ${seconds} segundos`;
                }
            });
        }

        updateCountdowns(); // Initial call
        setInterval(updateCountdowns, 1000); // Update every second for real-time countdown
    });
</script>
