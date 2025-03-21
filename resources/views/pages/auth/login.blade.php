@extends('template.layout')
@section('title', 'Login')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 shadow-lg d-flex flex-column justify-content-center px-5">
                <div class="d-flex flex-column align-items-center">
                    <h3 class="text-white"><i class="fa-light fa-notebook"></i> TodoMate</h3>
                    <p class="text-gray text-center">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eius accusamus, adipisci explicabo maiores earum sequi?</p>
                </div>
                <div class="mt-4 text-white">
                    <form action="{{ route('login') }}" class="form-group" method="POST">
                        @csrf
                        <div>
                            <label for="username" class="form-label"><i class="fa-light fa-user"></i> Username</label>
                            <input value="{{ old('username') }}" type="text" class="form-control" name="username" required>
                        </div>
                        <div class="mt-3">
                            <label for="password" class="form-label"><i class="fa-light fa-lock"></i> Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mt-3 d-flex">
                            <input type="checkbox" class="form-check" name="remember" id="remember">
                            <small for="remember" class="ms-1">Remember Me</small>
                        </div>
                        <div class="mt-3">
                            <button class="btn mb-1 w-100 btn-warning text-white">Sign In</button>
                            <div class="d-flex justify-content-end">
                                <small>Forgot Password?</small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-8">

            </div>
        </div>
    </div>
    @include('components.notification')
@endsection
@push('js')
    <script>
        // js
    </script>
@endpush
