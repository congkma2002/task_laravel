@extends('auth.layout')

@section('title', 'Login')

@php
    $header = 'Sign In to Your Account';
@endphp

@section('content')
<form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
    @csrf
    
    <div class="mb-4">
        <div class="form-floating">
            <input type="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   id="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   placeholder="email@example.com" 
                   required
                   autofocus>
            <label for="email">
                <i class="fas fa-envelope me-1 text-muted"></i>Email
            </label>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="mb-4">
        <div class="form-floating">
            <input type="password" 
                   class="form-control @error('password') is-invalid @enderror" 
                   id="password" 
                   name="password" 
                   placeholder="Password" 
                   required>
            <label for="password">
                <i class="fas fa-lock me-1 text-muted"></i>Password
            </label>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="d-grid gap-2 mb-4">
        <button type="submit" class="btn btn-primary py-2">
            <i class="fas fa-sign-in-alt me-2"></i>Sign In
        </button>
    </div>
</form>

@push('scripts')
<script>
// Form validation
(function () {
    'use strict'
    
    var forms = document.querySelectorAll('.needs-validation')
    
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                
                form.classList.add('was-validated')
            }, false)
        })
})()
</script>
@endpush

@endsection

@section('auth-footer')
    <p class="mb-0 text-center">
        Don't have an account? 
        <a href="{{ route('register.show') }}" class="text-decoration-none fw-medium">
            Sign up 
        </a>
    </p>
@endsection