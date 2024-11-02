<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            @foreach ($columns as $key => $column)
                <th>{{ $column }}</th>
            @endforeach
            @if (!empty($actions))
                <th>Actions</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach ($items as $item)
            <tr>
                @foreach ($columns as $key => $column)
                    <td>{{ $item->$key }}</td>
                @endforeach
                @if (!empty($actions))
                    <td>
                        @foreach ($actions as $action)
                            @if ($action['confirm'] ?? false)
                                <!-- Button to open confirmation modal -->
                                <button type="button" class="btn btn-{{ $action['class'] ?? 'primary' }} btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmationModal"
                                        data-route="{{ route($action['route'], $item->id) }}"
                                        data-method="{{ $action['method'] ?? 'POST' }}">
                                    {{ $action['label'] }}
                                </button>
                            @else
                                <!-- Form for non-confirmed actions -->
                                @if(empty($action['method']) || $action['method'] === 'GET')
                                    <a href="{{ route($action['route'], $item->id) }}"
                                       class="btn btn-{{ $action['class'] ?? 'primary' }} btn-sm">{{ $action['label'] }}</a>
                                @else
                                    <form action="{{ route($action['route'], $item->id) }}" method="POST"
                                          class="d-inline action-form">
                                        @csrf
                                        @if (!in_array(strtoupper($action['method'] ?? 'GET'), ['GET', 'POST']))
                                            @method($action['method'])
                                        @endif
                                        <button type="submit"
                                                class="btn btn-{{ $action['class'] ?? 'primary' }} btn-sm">
                                            {{ $action['label'] }}
                                        </button>
                                    </form>
                                @endif
                            @endif
                        @endforeach
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $items->links() }}
</div>

<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Está seguro que desea realizar esta acción?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="confirmActionForm" method="POST" action="#">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">
                    <button type="submit" class="btn btn-danger">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const confirmationModal = document.getElementById('confirmationModal');
        const confirmActionForm = document.getElementById('confirmActionForm');
        const formMethodInput = document.getElementById('formMethod');

        // Handle the confirmation modal for confirmable actions
        confirmationModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const route = button.getAttribute('data-route');
            const method = button.getAttribute('data-method') || 'POST';

            confirmActionForm.setAttribute('action', route);
            formMethodInput.value = method.toUpperCase();
        });

        // Handle direct form submissions for non-confirmable actions
        document.querySelectorAll('.action-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                const method = form.querySelector('input[name="_method"]')?.value || 'POST';
                if (method === 'GET') {
                    // Prevent form submission for GET requests and redirect instead
                    e.preventDefault();
                    window.location.href = form.getAttribute('action');
                }
            });
        });
    });
</script>

