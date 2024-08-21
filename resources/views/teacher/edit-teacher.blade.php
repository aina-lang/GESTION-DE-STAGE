@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Ajout un encadreur</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="teachers.html">Encadreur</a></li>
                            <li class="breadcrumb-item active">Ajout encadreur</li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('teacher/update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <input hidden name="id" value="{{$teacher->id}}"/>
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Informations de l'Encadreur</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nom <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('Nom') is-invalid @enderror"
                                                name="Nom" placeholder="Rakoto" value="{{ $teacher->Nom }}">
                                            @error('Nom')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Prenoms<span class="login-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('Prenoms') is-invalid @enderror" name="Prenoms"
                                                placeholder="Rabe" value="{{ $teacher->Prenoms }}">
                                            @error('Prenoms')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Département <span class="login-danger">*</span></label>
                                            <select class="form-control select @error('department_id') is-invalid @enderror"
                                                name="department_id">
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}"
                                                        {{ old('department_id') == $department->id || $teacher->department_id == $department->id ? 'selected' : '' }}>
                                                        {{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('department_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Telephone <span class="login-danger">*</span></label>
                                            <input class="form-control @error('Telephone') is-invalid @enderror"
                                                type="text" name="Telephone" placeholder="Entrer numero telephone"
                                                value="{{ $teacher->Telephone }}">
                                            @error('Telephone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>E-Mail <span class="login-danger">*</span></label>
                                            <input class="form-control @error('email') is-invalid @enderror" type="text"
                                                name="email" placeholder="Entrer un Addresse Email "
                                                value="{{ $teacher->email }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Adresse <span class="login-danger">*</span></label>
                                            <input class="form-control @error('adresse') is-invalid @enderror"
                                                type="text" name="adresse" placeholder="Maninday toliara"
                                                value="{{ $teacher->adresse }}">
                                            @error('adresse')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Rôle <span class="login-danger">*</span></label>
                                            <select class="form-control select @error('grade') is-invalid @enderror"
                                                name="grade" id="grade">
                                                <option selected  value="{{ $teacher->grade }}">
                                                    {{ $teacher->grade }}</option>
                                                <option value="Ingénieur">Ingénieur</option>
                                                <option value="HDR">HDR</option>
                                            </select>
                                            @error('grade')
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
