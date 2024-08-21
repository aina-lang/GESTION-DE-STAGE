{{-- resources/views/department/edit-department.blade.php --}}

@extends('layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Éditer Département</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('departments.list') }}">Départements</a></li>
                                <li class="breadcrumb-item active">Éditer Département</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Message --}}
            {!! Toastr::message() !!}
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('departments.update', $department->id) }}" method="POST">
                                @csrf
                                @method('PUT') {{-- Méthode PUT pour l'update --}}
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title">Informations Département</h5>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Nom du Département <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Entrer Nom" value="{{ old('name', $department->name) }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Description du Département <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Entrer Description" value="{{ old('description', $department->description) }}">
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="department-submit">
                                            <button type="submit" class="btn btn-primary">Sauvegarder les Modifications</button>
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
