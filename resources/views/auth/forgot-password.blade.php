@extends('auth.app-auth')

@section('auth-content')
<div class="card-body login-card-body">

    <p class="login-box-msg">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>

    <form action="{{ route('password.email') }}" method="POST">
        @csrf

        <!-- Email Field -->
        <div class="input-group has-validation mb-3">
            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required>

            @error('email')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Remember & Submit -->
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary w-100">
                    {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </div>
    </form>

</div>
@endsection
