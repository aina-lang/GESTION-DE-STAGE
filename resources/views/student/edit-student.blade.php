@extends('layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Modifier Étudiant</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('student/add/page') }}">Étudiants</a></li>
                                <li class="breadcrumb-item active">Modifier Étudiant</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Message -->
            {!! Toastr::message() !!}

            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('student/update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $studentEdit->id }}">

                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">
                                            Informations Étudiant
                                            <span>
                                                <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                            </span>
                                        </h5>
                                    </div>

                                    <!-- Nom -->
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nom <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('Nom') is-invalid @enderror"
                                                name="Nom" placeholder="Entrer Nom"
                                                value="{{ old('Nom', $studentEdit->Nom) }}">
                                            @error('Nom')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Prénoms -->
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Prénoms <span class="login-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('Prenoms') is-invalid @enderror" name="Prenoms"
                                                value="{{ old('Prenoms', $studentEdit->Prenoms) }}">
                                            @error('Prenoms')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Genre -->
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Genre <span class="login-danger">*</span></label>
                                            <select class="form-control select @error('Genre') is-invalid @enderror"
                                                name="Genre">
                                                <option value="" disabled>Sélectionner Genre</option>
                                                <option value="Féminin"
                                                    {{ old('Genre', $studentEdit->Genre) == 'Féminin' ? 'selected' : '' }}>
                                                    Féminin</option>
                                                <option value="Masculin"
                                                    {{ old('Genre', $studentEdit->Genre) == 'Masculin' ? 'selected' : '' }}>
                                                    Masculin</option>
                                                <option value="Autre"
                                                    {{ old('Genre', $studentEdit->Genre) == 'Autre' ? 'selected' : '' }}>
                                                    Autre</option>
                                            </select>
                                            @error('Genre')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Âge -->
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Âge <span class="login-danger">*</span></label>
                                            <input class="form-control @error('Age') is-invalid @enderror" name="Age"
                                                type="number" value="{{ old('Age', $studentEdit->Age) }}">
                                            @error('Age')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Adresse -->
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Adresse</label>
                                            <input class="form-control @error('Adresse') is-invalid @enderror"
                                                type="text" name="Adresse"
                                                value="{{ old('Adresse', $studentEdit->Adresse) }}">
                                            @error('Adresse')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- E-Mail -->
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>E-Mail <span class="login-danger">*</span></label>
                                            <input class="form-control @error('email') is-invalid @enderror" type="email"
                                                name="email" value="{{ old('email', $studentEdit->email) }}">
                                            @error('email')
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
                                                        {{ old('department_id') == $department->id || $studentEdit->department_id == $department->id ? 'selected' : '' }}>
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

                                    <!-- Matricule -->
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Matricule <span class="login-danger">*</span></label>
                                            <input class="form-control @error('matricule') is-invalid @enderror"
                                                type="text" name="matricule"
                                                value="{{ old('matricule', $studentEdit->matricule) }}">
                                            @error('matricule')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <!-- Niveau -->
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Niveau <span class="login-danger">*</span></label>
                                            <select class="form-control select @error('Niveau') is-invalid @enderror"
                                                name="Niveau">
                                                <option value="" disabled>Sélectionner Niveau</option>
                                                <option value="L1"
                                                    {{ old('Niveau', $studentEdit->Niveau) == 'L1' ? 'selected' : '' }}>L1
                                                </option>
                                                <option value="L2"
                                                    {{ old('Niveau', $studentEdit->Niveau) == 'L2' ? 'selected' : '' }}>L2
                                                </option>
                                                <option value="L3"
                                                    {{ old('Niveau', $studentEdit->Niveau) == 'L3' ? 'selected' : '' }}>L3
                                                </option>
                                                <option value="M1"
                                                    {{ old('Niveau', $studentEdit->Niveau) == 'M1' ? 'selected' : '' }}>M1
                                                </option>
                                                <option value="M2"
                                                    {{ old('Niveau', $studentEdit->Niveau) == 'M2' ? 'selected' : '' }}>M2
                                                </option>
                                            </select>
                                            @error('Niveau')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Téléphone -->
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Téléphone</label>
                                            <input class="form-control @error('Telephone') is-invalid @enderror"
                                                type="text" name="Telephone"
                                                value="{{ old('Telephone', $studentEdit->Telephone) }}">
                                            @error('Telephone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Photo -->
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group students-up-files">
                                            <label>Insérer la Photo (Formats: jpg, jpeg, png. Taille max: 2 Mo.)</label>
                                            <input type="file"
                                                class="form-control @error('upload') is-invalid @enderror" name="upload"
                                                onchange="previewImage(event)">
                                            @error('upload')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <p class="mb-0">Formats: jpg, jpeg, png. Taille max: 2 Mo.</p>
                                            <img id="imagePreview"
                                                src="{{ Storage::url('student-photos/' . $studentEdit->upload) }}"
                                                alt="Image Preview" style="width: 150px; height: auto; margin-top: 10px;">
                                        </div>
                                    </div>

                                    <!-- Save Button -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Enregistrer les
                                                modifications</button>
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

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
