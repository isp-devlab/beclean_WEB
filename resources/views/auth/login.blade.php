@extends('layouts.auth')

@section('content')
    <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" id="login-form" method="POST" action="{{ route('login.submit') }}">
        @csrf
        <div class="mb-11">
            <h1 class="text-gray-900 fw-bolder mb-3">
                Welcome Back!
            </h1>
            <div class="text-gray-500 fw-semibold fs-6">
                Enter your credentials to access your account.
            </div>
        </div>
        @if (session()->has('error'))
        <div class="alert alert-danger" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill fs-2 me-3" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
            </svg>
            {{ session('error') }}
        </div>
        @endif
        <div class="fv-row mb-8 fv-plugins-icon-container">
            <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent @error('email') is-invalid @enderror" value="{{ old('email') }}" required> 
            @error('email')
            <div class="invalid-feedback text-red-1">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="fv-row mb-3 fv-plugins-icon-container">    
            <input type="password" placeholder="********" name="password" autocomplete="off" class="form-control bg-transparent @error('password') is-invalid @enderror" required>
            @error('password')
            <div class="invalid-feedback text-red-1">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">    
            <a href="/metronic8/demo1/authentication/layouts/corporate/reset-password.html" class="link-primary">
                Forgot Password ?
            </a>
        </div>

        <div class="d-grid mb-10">
            <button type="submit" id="submit" class="btn btn-primary" fdprocessedid="ra9kde">
                <span class="indicator-label">Sign In</span>    
                <span class="indicator-progress" style="display: none;"> 
                    Please wait...    
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </div>
    </form>
@endsection

@section('script')
<script>
    document.getElementById('login-form').addEventListener('submit', function(event) {
        var button = document.getElementById('submit');
        var label = button.querySelector('.indicator-label');
        var progress = button.querySelector('.indicator-progress');

        label.style.display = 'none';
        progress.style.display = 'inline-block';

        button.disabled = true;
    });
</script>
@endsection
