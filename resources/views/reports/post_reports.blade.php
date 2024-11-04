@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Reportes de publicaciones</h1>
                <table>
                    <thead>
                    <tr>
                        <th>Título</th>
                        <th>Usuario</th>
                        <th>Comentario</th>
                        <th>Fecha</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($postReports as $report)
                        <tr>
                            <td>{{ $report->post->title }}</td>
                            <td>{{ $report->user->email }}</td>
                            <td>{{ $report->reported_reason }}</td>
                            <td>{{ $report->reported_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
