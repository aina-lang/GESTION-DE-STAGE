@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Ajout Étudiant</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('student/list') }}">Étudiants</a></li>
                                <li class="breadcrumb-item active">Ajout Étudiant</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('student/add/save') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Informations de l'Étudiant
                                            <span>
                                                <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nom <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('Nom') is-invalid @enderror"
                                                name="Nom" placeholder="Entrer le nom" value="{{ old('Nom') }}">
                                            @error('Nom')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Prénoms <span class="login-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('Prenoms') is-invalid @enderror" name="Prenoms"
                                                placeholder="Entrer les prénoms" value="{{ old('Prenoms') }}">
                                            @error('Prenoms')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Genre <span class="login-danger">*</span></label>
                                            <select class="form-control select  @error('Genre') is-invalid @enderror"
                                                name="Genre">
                                                {{-- <option  disabled>Choisir le genre</option> --}}
                                                <option selected value="Féminin" {{ old('Genre') == 'Féminin' ? 'selected' : '' }}>
                                                    Féminin</option>
                                                <option value="Masculin" {{ old('Genre') == 'Masculin' ? 'selected' : '' }}>
                                                    Masculin</option>
                                                <option value="Autre" {{ old('Genre') == 'Autre' ? 'selected' : '' }}>Autre
                                                </option>
                                            </select>
                                            @error('Genre')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Âge <span class="login-danger">*</span></label>
                                            <input class="form-control @error('Age') is-invalid @enderror" name="Age"
                                                type="number" placeholder="Entrer l'âge" value="{{ old('Age') }}">
                                            @error('Age')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Adresse</label>
                                            <input class="form-control @error('Adresse') is-invalid @enderror"
                                                type="text" name="Adresse" placeholder="Entrer l'adresse"
                                                value="{{ old('Adresse') }}">
                                            @error('Adresse')
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
                                                name="email" placeholder="Entrer une adresse e-mail"
                                                value="{{ old('email') }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Niveau <span class="login-danger">*</span></label>
                                            <select class="form-control select @error('Niveau') is-invalid @enderror"
                                                name="Niveau">
                                                {{-- <option  disabled>Choisir le niveau</option> --}}
                                                <option selected value="L1" {{ old('Niveau') == 'L1' ? 'selected' : '' }}>L1
                                                </option>
                                                <option value="L2" {{ old('Niveau') == 'L2' ? 'selected' : '' }}>L2
                                                </option>
                                                <option value="L3" {{ old('Niveau') == 'L3' ? 'selected' : '' }}>L3
                                                </option>
                                                <option value="M1" {{ old('Niveau') == 'M1' ? 'selected' : '' }}>M1
                                                </option>
                                                <option value="M2" {{ old('Niveau') == 'M2' ? 'selected' : '' }}>M2
                                                </option>
                                            </select>
                                            @error('Niveau')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Téléphone</label>
                                            <input class="form-control @error('Telephone') is-invalid @enderror"
                                                type="text" name="Telephone" placeholder="Entrer le numéro de téléphone"
                                                value="{{ old('Telephone') }}">
                                            @error('Telephone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group students-up-files">
                                            <label>Insérer la Photo (150px X 150px)</label>
                                            <div class="uplod">
                                                <label class="file-upload image-upbtn mb-0 @error('upload') is-invalid @enderror">
                                                    Choisir le fichier <input type="file" name="upload"
                                                        onchange="previewImage(event)">
                                                </label>
                                                <img id="imagePreview" style="max-height: 150px; margin-top: 10px;" />
                                                @error('upload')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
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
