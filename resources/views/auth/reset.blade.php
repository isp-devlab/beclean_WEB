@extends('layouts.auth')

@section('content')
    <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" id="login-form" method="POST" action="{{ route('reset.submit', $token) }}">
        @csrf
        <div class="mb-11">
            <h1 class="text-gray-900 fw-bolder mb-3">
                Reset Password
            </h1>
            <div class="text-gray-500 fw-semibold fs-6">
                Setup your new password
            </div>
        </div>
        <div class="fv-row mb-8">
          <div class="alert alert-dismissible bg-light-dark border border-dashed border-dark d-flex align-items-center flex-column flex-sm-row">
            <div class="symbol-label">
              <div class="symbol symbol-circle symbol-40px overflow-hidden me-5">
                  <div class="symbol-label">
                    <img src="https://ui-avatars.com/api/?name={{ $user->name }}" alt="" class="w-100">
                  </div>
              </div>
            </div>
            <div class="d-flex flex-column pe-0 pe-sm-10">
                <h4 class="mb-1 fs-6">{{ $user->name }}</h4>
                <span class="text-muted fs-7">{{ $user->email }}</span>
            </div>
          </div>
          <input type="hidden" placeholder="email" name="email" value="{{ $user->email }}" />
        </div>
        <div class="fv-row mb-8">
          <input type="password" placeholder="Password Baru" name="password" autocomplete="off" class="form-control bg-transparent @error('password') is-invalid @enderror" value="{{ old('password') }}" />
          @error('password')
          <div class="text-sm text-danger">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="d-grid mb-10">
            <button type="submit" id="submit" class="btn btn-primary" fdprocessedid="ra9kde">
                <span class="indicator-label">Change Password</span>    
                <span class="indicator-progress" style="display: none;"> 
                    Please wait...    
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
            <a href="{{ route('login') }}" class="btn btn-light">
              Cancel
            </a>
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
