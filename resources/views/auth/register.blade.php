@extends('layouts.app')

@section('content')
    <div class="login-right">
        <div class="login-right-wrap">
            <h1>S'inscrire</h1>

            {{-- message --}}
            {!! Toastr::message() !!}

            <p class="account-subtitle">Déjà un compte? <a href="{{ route('login') }}">Se connecter</a></p>

            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nom complet<span class="login-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                    <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email <span class="login-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email">
                    <span class="profile-views"><i class="fas fa-envelope"></i></span>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- insert defaults --}}
                <input type="hidden" class="image" name="image" value="photo_defaults.jpg">

                {{-- Uncomment and use this if needed --}}
                {{-- <div class="form-group local-forms">
                    <label>Rôle <span class="login-danger">*</span></label>
                    <select class="form-control select @error('role_name') is-invalid @enderror" name="role_name" id="role_name">
                        <option selected disabled>Choisissez un rôle</option>
                        @foreach ($role as $name)
                            <option value="{{ $name->role_type }}">{{ $name->role_type }}</option>
                        @endforeach
                    </select>
                    @error('role_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> --}}

                <div class="form-group">
                    <label>Mot de passe <span class="login-danger">*</span></label>
                    <input type="password" class="form-control pass-input @error('password') is-invalid @enderror" name="password">
                    <span class="profile-views feather-eye toggle-password"></span>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Confirmation mot de passe <span class="login-danger">*</span></label>
                    <input type="password" class="form-control pass-confirm @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                    <span class="profile-views feather-eye reg-toggle-password"></span>
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-0 form-group">
                    <button class="btn btn-primary btn-block" type="submit">S'inscrire</button>
                </div>
            </form>

            {{-- <div class="login-or">
                <span class="or-line"></span>
                <span class="span-or">ou</span>
            </div>
            <div class="social-login">
                <a href="#"><i class="fab fa-google-plus-g"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div> --}}
        </div>
    </div>
@endsection
