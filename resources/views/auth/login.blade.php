@extends('auth.app-auth')

@section('auth-content')
<div class="card-body login-card-body">

    <p class="login-box-msg">Sign in to start your session</p>

    <form action="{{ route('login') }}" method="POST">
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

        <!-- Password Field -->
        <div class="input-group has-validation mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
            @error('password')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Remember & Submit -->
        <div class="row">
            <div class="col-8">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                </div>
            </div>

            <div class="col-4">
                <button type="submit" class="btn btn-primary w-100">
                    Sign In
                </button>
            </div>
        </div>
    </form>

    <!-- Links -->
    @if (Route::has('password.request'))
    <p class="mb-1">
        <a href="{{ route('password.request') }}">I forgot my password</a>
    </p>
    @endif

    <p class="mb-0">
        <a href="{{ route('register') }}" class="text-center">
            Register a new membership
        </a>
    </p>

</div>
@endsection