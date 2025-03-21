@extends('template.layout')
@section('title', 'Dashboard')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush
@section('content')
    <h1>INI ADALAH ADMIN DASHBOARD</h1>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">LOGOUT</button>
    </form>
    @include('components.notification')
@endsection
@push('js')
    <script>
        // js
    </script>
@endpush
