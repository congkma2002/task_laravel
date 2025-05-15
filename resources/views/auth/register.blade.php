@extends('auth.layout')

@section('title', 'Register')

@php
    $header = 'Create Account';
@endphp

@section('content')
<form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
    @csrf
    
    <div class="mb-4">
        <div class="form-floating">
            <input type="text" 
                   class="form-control @error('name') is-invalid @enderror" 
                   id="name" 
                   name="name" 
                   value="{{ old('name') }}" 
                   placeholder="Your name" 
                   required
                   autofocus>
            <label for="name">
                <i class="fas fa-user me-1 text-muted"></i>Full Name
            </label>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="mb-4">
        <div class="form-floating">
            <input type="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   id="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   placeholder="email@example.com" 
                   required>
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

    <div class="mb-4">
        <div class="form-floating">
            <input type="password" 
                   class="form-control @error('password_confirmation') is-invalid @enderror" 
                   id="password_confirmation" 
                   name="password_confirmation" 
                   placeholder="Confirm Password" 
                   required>
            <label for="password_confirmation">
                <i class="fas fa-lock me-1 text-muted"></i>Confirm Password
            </label>
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary py-2">
                <i class="fas fa-user-plus me-2"></i>Create Account
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
                
                // Check if passwords match
                var password = document.getElementById('password')
                var confirmPassword = document.getElementById('password_confirmation')
                
                if (password.value !== confirmPassword.value) {
                    confirmPassword.setCustomValidity("Passwords don't match")
                    confirmPassword.classList.add('is-invalid')
                    event.preventDefault()
                    event.stopPropagation()
                } else {
                    confirmPassword.setCustomValidity('')
                    confirmPassword.classList.remove('is-invalid')
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
        Already have an account? 
        <a href="{{ route('login.show') }}" class="text-decoration-none fw-medium">
            Sign in
        </a>
    </p>
@endsection