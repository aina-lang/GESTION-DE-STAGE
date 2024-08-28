@extends('layouts.master')

@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Liste des Stages</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                            <li class="breadcrumb-item active">Liste des Stages</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Liste des Stages</h3>
                                    </div>
                                    <div class="col-auto text-end ms-auto download-grp">
                                        <a href="{{ route('stage.download') }}" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Télécharger Liste</a>
                                        <a href="{{ route('stage.add') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter</a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="DataList" class="table border-0 table-hover table-center mb-0 datatable table-striped">
                                    <thead>
                                        <tr>
                                            <th>Étudiant</th>
                                            <th>Partenariat</th>
                                            <th>Thème</th>
                                            <th>Date de début</th>
                                            <th>Date de fin</th>
                                            <th>Encadrant</th> <!-- Nouvelle colonne -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stages as $stage)
                                            <tr>
                                                <td style="display: flex;">{{ $stage->student->Nom }} {{ $stage->student->Prenoms }}</td>
                                                <td>{{ $stage->partenaire->nom }}</td>
                                                <td>{{ $stage->theme }}</td>
                                                <td>{{ $stage->start_date }}</td>
                                                <td>{{ $stage->end_date }}</td>
                                                <td>{{ $stage->teacher->Nom }} {{ $stage->teacher->Prenoms }}</td> <!-- Affichage de l'encadrant -->
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a href="{{ route('stage.edit', $stage->id) }}" class="btn btn-sm bg-warning-light me-2">
                                                            <i class="feather-edit"></i>
                                                        </a>
                                                        <a href="{{ route('stage.pdf', $stage->id) }}" class="btn btn-sm bg-info-light me-2">
                                                            <i class="feather-file-text"></i>
                                                        </a>
                                                        <button class="btn btn-sm bg-danger-light stage_delete" data-id="{{ $stage->id }}" data-bs-toggle="modal" data-bs-target="#stageDelete">
                                                            <i class="feather-trash-2"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal suppression stage --}}
    <div class="modal fade" id="stageDelete" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header pb-0 border-bottom-0 justify-content-end">
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Fermer"><i class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <form id="deleteForm" action="{{ route('stage.delete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="delete-wrap text-center">
                            <div class="del-icon">
                                <i class="feather-x-circle"></i>
                            </div>
                            <input type="hidden" name="id" id="stageId" value="">
                            <h2>Êtes-vous sûr de vouloir supprimer ce stage ?</h2>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-success me-2">Oui</button>
                                <a class="btn btn-danger" data-bs-dismiss="modal">Non</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@section('script')
    <script>
        $(document).on('click', '.stage_delete', function() {
            var stageId = $(this).data('id');
            var formAction = "{{ route('stage.delete') }}"; 
            $('#deleteForm').attr('action', formAction);
            $('#stageId').val(stageId); 
        });
    </script>
@endsection
@endsection
