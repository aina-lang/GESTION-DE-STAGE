@extends('layouts.master')

@section('content')
{{-- message --}}
{!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Modifier le Partenaire</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('partenariats.list') }}">Partenariats</a></li>
                            <li class="breadcrumb-item active">Modifier le Partenaire</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('partenariats.update', $partenariat->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Détails du Partenaire</span></h5>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Nom du Partenaire <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" name="nom" value="{{ $partenariat->nom }}" required>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Email <span class="login-danger">*</span></label>
                                            <input type="email" class="form-control" name="email" value="{{ $partenariat->email }}" required>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Téléphone <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" name="telephone" value="{{ $partenariat->telephone }}" required>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Adresse <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" name="adresse" value="{{ $partenariat->adresse }}" required>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Secteur <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" name="secteur" value="{{ $partenariat->secteur }}" required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary">Soumettre</button>
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
