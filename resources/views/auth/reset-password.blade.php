@extends('auth.app-auth')

@section('auth-content')
<div class="card">
    <div class="card-body register-card-body">
        <p class="register-box-msg">Reset Password</p>
        <form action="{{ route('password.store') }}" method="post">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="input-group mb-3">
                <input type="email" class="form-control" name="email" value="{{ old('email', $request->email) }}" required autocomplete="email" placeholder="Email" />
                @error('email')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" id="password" name="password" required autocomplete="new-password" />
                @error('password')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" />
                @error('password_confirmation')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <!--begin::Row-->
            <div class="row">
                <div class="col-8 offset-4">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">{{ __('Reset Password') }}</button>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->
        </form>
    </div>
    <!-- /.register-card-body -->
</div>
@endsection
