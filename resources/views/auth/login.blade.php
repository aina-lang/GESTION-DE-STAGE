@extends('layouts.app')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="login-right">
        <div class="login-right-wrap">
            <h1>Bievenue</h1>
            <p class="account-subtitle">Vous n'avez pas de compte? <a href="{{ route('register') }}">S'inscrire ici</a></p>
            <h2>Se connecter</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Email<span class="login-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email">
                    <span class="profile-views"><i class="fas fa-envelope"></i></span>
                </div>
                <div class="form-group">
                    <label>Mot de passe <span class="login-danger">*</span></label>
                    <input type="password" class="form-control pass-input @error('password') is-invalid @enderror"
                        name="password">
                    <span class="profile-views feather-eye toggle-password"></span>
                </div>
                <div class="forgotpass">
                    <div class="remember-me">
                        <label class="mb-0 mr-2 custom_check d-inline-flex remember-me"> Se souviens de moi
                            <input type="checkbox" name="radio">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    {{-- <a href="forgot-password.html">Mot de passe oublié?</a> --}}
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Se connecter</button>
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
