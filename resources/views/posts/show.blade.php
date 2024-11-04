@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row align-items-start justify-content-start">
            <div class="col-12 col-md-10">
                <x-post-card :post="$post"/>
            </div>
        </div>
    </div>
@endsection
