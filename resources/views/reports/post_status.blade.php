@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row align-items-start justify-content-start">
            <div class="col-12 col-md-10">
                <h1>Resumen de estados de publicaciones</h1>
                <table>
                    <thead>
                    <tr>
                        <th>Status</th>
                        <th>Total Posts</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($statuses as $status)
                        <tr>
                            <td>{{ $status->status }}</td>
                            <td>{{ $status->total }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
