@extends('auth.app-auth')

@section('auth-content')
<div class="card">
    <div class="card-body register-card-body">
        <p class="register-box-msg">Register a new membership</p>
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Name" />
                @error('name')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" />
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
                <div class="col-8">

                </div>
                <!-- /.col -->
                <div class="col-4">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Sign In</button>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->
        </form>

        <!-- /.social-auth-links -->
        <p class="mb-0">
            <a href="{{ route('login') }}" class="text-center"> I already have a membership </a>
        </p>
    </div>
    <!-- /.register-card-body -->
</div>
@endsection
