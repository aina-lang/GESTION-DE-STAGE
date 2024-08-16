@extends('layouts.master')

@section('content')
    {!! Toastr::message() !!}

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Modifier le Stage</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('stage.list') }}">Liste des Stages</a></li>
                            <li class="breadcrumb-item active">Modifier le Stage</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('stage.update', $stage->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Détails du Stage</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Thème du Stage <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('theme') is-invalid @enderror"
                                                name="theme" placeholder="Thème du Stage" value="{{ old('theme', $stage->theme) }}"
                                                required>
                                            @error('theme')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Partenaire <span class="login-danger">*</span></label>
                                            <select
                                                class="form-control select2 @error('partenaire_id') is-invalid @enderror"
                                                name="partenaire_id" required>
                                                <option value="">Sélectionner un partenaire</option>
                                                @foreach ($partenaires as $partenaire)
                                                    <option value="{{ $partenaire->id }}"
                                                        {{ old('partenaire_id', $stage->partenaire_id) == $partenaire->id ? 'selected' : '' }}>
                                                        {{ $partenaire->nom }}</option>
                                                @endforeach
                                            </select>
                                            @error('partenaire_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Date de Début <span class="login-danger">*</span></label>
                                            <input
                                                class="form-control datetimepicker @error('start_date') is-invalid @enderror"
                                                type="text" name="start_date" placeholder="JJ-MM-AAAA"
                                                value="{{ old('start_date', $stage->start_date) }}" required>
                                            @error('start_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Date de Fin <span class="login-danger">*</span></label>
                                            <input
                                                class="form-control datetimepicker @error('end_date') is-invalid @enderror"
                                                type="text" name="end_date" placeholder="JJ-MM-AAAA"
                                                value="{{ old('end_date', $stage->end_date) }}" required>
                                            @error('end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Étudiant <span class="login-danger">*</span></label>
                                            <select class="form-control select2 @error('student_id') is-invalid @enderror"
                                                name="student_id" required>
                                                <option value="">Sélectionner un étudiant</option>
                                                @foreach ($etudiants as $etudiant)
                                                    <option value="{{ $etudiant->id }}"
                                                        {{ old('student_id', $stage->student_id) == $etudiant->id ? 'selected' : '' }}>
                                                        {{ $etudiant->Nom }}</option>
                                                @endforeach
                                            </select>
                                            @error('student_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
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

@section('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Sélectionner une option",
                allowClear: true
            });
            $('form').on('submit', function(event) {
                var startDate = new Date($('input[name="start_date"]').val());
                var endDate = new Date($('input[name="end_date"]').val());
                var today = new Date();
                today.setHours(0, 0, 0, 0);
                if (startDate < today) {
                    event.preventDefault();
                    alert('La date de début doit être égale ou après aujourd\'hui.');
                }

                if (endDate <= startDate) {
                    event.preventDefault();
                    alert('La date de fin doit être après la date de début.');
                }
            });
        });
    </script>
@endsection
