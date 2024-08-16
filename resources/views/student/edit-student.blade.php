@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

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
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('student/update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" name="id" value="{{ $studentEdit->id }}" readonly>
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Informations Étudiant
                                            <span>
                                                <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nom <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('Nom') is-invalid @enderror" name="Nom" placeholder="Entrer Nom" value="{{ $studentEdit->Nom }}">
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
                                            <input type="text" class="form-control @error('Prenoms') is-invalid @enderror" name="Prenoms" value="{{ $studentEdit->Prenoms }}">
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
                                            <select class="form-control select @error('Genre') is-invalid @enderror" name="Genre">
                                                <option selected disabled>Sélectionner Genre</option>
                                                <option value="Féminin" {{ $studentEdit->Genre == 'Féminin' ? 'selected' : '' }}>Féminin</option>
                                                <option value="Masculin" {{ $studentEdit->Genre == 'Masculin' ? 'selected' : '' }}>Masculin</option>
                                                <option value="Autre" {{ $studentEdit->Genre == 'Autre' ? 'selected' : '' }}>Autre</option>
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
                                            <input class="form-control @error('Age') is-invalid @enderror" name="Age" type="number" value="{{ $studentEdit->Age }}">
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
                                            <input class="form-control @error('Adresse') is-invalid @enderror" type="text" name="Adresse" value="{{ $studentEdit->Adresse }}">
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
                                            <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" value="{{ $studentEdit->email }}">
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
                                            <select class="form-control select @error('Niveau') is-invalid @enderror" name="Niveau">
                                                <option disabled>Sélectionner Niveau</option>
                                                <option value="L1" {{ $studentEdit->Niveau == 'L1' ? 'selected' : '' }}>L1</option>
                                                <option value="L2" {{ $studentEdit->Niveau == 'L2' ? 'selected' : '' }}>L2</option>
                                                <option value="L3" {{ $studentEdit->Niveau == 'L3' ? 'selected' : '' }}>L3</option>
                                                <option value="M1" {{ $studentEdit->Niveau == 'M1' ? 'selected' : '' }}>M1</option>
                                                <option value="M2" {{ $studentEdit->Niveau == 'M2' ? 'selected' : '' }}>M2</option>
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
                                            <input class="form-control @error('Telephone') is-invalid @enderror" type="text" name="Telephone" value="{{ $studentEdit->Telephone }}">
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
                                                    Choisir le fichier <input type="file" name="upload" onchange="previewImage(event)">
                                                </label>
                                                <input type="hidden" name="image_hidden" value="{{ $studentEdit->upload }}">
                                                <img id="imagePreview" style="max-height: 150px; margin-top: 10px;" src="{{ Storage::url('student-photos/' . $studentEdit->upload) }}" />
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
                                            <button type="submit" class="btn btn-primary">Modifier</button>
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
