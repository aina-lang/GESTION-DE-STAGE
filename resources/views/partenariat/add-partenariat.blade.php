@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Ajouter un partenariat</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('partenariats.list') }}">Partenariats</a></li>
                            <li class="breadcrumb-item active">Ajouter partenariat</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            {{-- Message --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('partenariats.save') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Informations du partenariat</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="form-group local-forms">
                                            <label>Nom <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                                name="nom" placeholder="Nom de l'organisation" value="{{ old('nom') }}">
                                            @error('nom')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="form-group local-forms">
                                            <label>Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" placeholder="Email de l'organisation" value="{{ old('email') }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="form-group local-forms">
                                            <label>Téléphone <span class="text-danger">*</span></label>
                                            <input class="form-control @error('telephone') is-invalid @enderror"
                                                type="text" name="telephone" placeholder="Téléphone de l'organisation" value="{{ old('telephone') }}">
                                            @error('telephone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="form-group local-forms">
                                            <label>Adresse <span class="text-danger">*</span></label>
                                            <input class="form-control @error('adresse') is-invalid @enderror"
                                                type="text" name="adresse" placeholder="Adresse de l'organisation" value="{{ old('adresse') }}">
                                            @error('adresse')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="form-group local-forms">
                                            <label>Secteur <span class="text-danger">*</span></label>
                                            <input class="form-control @error('secteur') is-invalid @enderror"
                                                type="text" name="secteur" placeholder="Secteur de l'organisation" value="{{ old('secteur') }}">
                                            @error('secteur')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                
                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary">Ajouter</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
