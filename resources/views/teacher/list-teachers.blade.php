@extends('layouts.master')

@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Encadreurs</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Tableau de bord</a></li>
                            <li class="breadcrumb-item active">Encadreurs</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- <div class="teacher-group-form">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Recherche par ID ...">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Recherche par nom ...">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Recherche par téléphone ...">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="search-teacher-btn">
                            <button type="btn" class="btn btn-primary">Recherche</button>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Encadreurs</h3>
                                    </div>
                                    <div class="col-auto text-end ms-auto download-grp">
                                        {{-- <a href="teachers.html" class="btn btn-outline-gray me-2 active"><i class="feather-list"></i></a>
                                        <a href="{{ route('teacher/grid/page') }}" class="btn btn-outline-gray me-2"><i class="feather-grid"></i></a> --}}
                                        {{-- <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Télécharger</a> --}}
                                        <a href="{{ route('teacher/add/page') }}" class="btn btn-primary"><i class="fas fa-plus"></i>Ajouter</a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="DataList" class="table border-0 table-hover table-center mb-0 datatable table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nom et prénoms</th>
                                            <th>Département</th>
                                            <th>Grade</th>
                                            <th>Téléphone</th>
                                            <th>Email</th>
                                            <th>Adresse</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listTeacher as $teacher)
                                            <tr>
                                                <td>{{ $teacher->Nom }} {{ $teacher->Prenoms }}</td>
                                                <td>{{ $teacher->department->name }}</td>
                                                <td>{{ $teacher->grade }}</td>
                                                <td>{{ $teacher->Telephone }}</td>
                                                <td>{{ $teacher->email }}</td>
                                                <td>{{ $teacher->adresse }}</td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a href="{{ url('teacher/edit/' . $teacher->id) }}" class="btn btn-sm bg-danger-light">
                                                            <i class="feather-edit"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm bg-danger-light teacher_delete" data-bs-toggle="modal" data-bs-target="#teacherDelete" data-id="{{ $teacher->id }}">
                                                            <i class="feather-trash-2 me-1"></i>
                                                        </a>
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

    {{-- Modal suppression enseignant --}}
    <div class="modal fade" id="teacherDelete" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header pb-0 border-bottom-0 justify-content-end">
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Fermer"><i class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('teacher/delete') }}" method="POST">
                        @csrf
                        <div class="delete-wrap text-center">
                            <div class="del-icon">
                                <i class="feather-x-circle"></i>
                            </div>
                            <input type="hidden" name="id" class="e_id" value="">
                            <h2>Êtes-vous sûr de vouloir supprimer ?</h2>
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
    {{-- JS suppression --}}
    <script>
        $(document).on('click', '.teacher_delete', function() {
            var id = $(this).data('id');
            $('.e_id').val(id);
        });
    </script>
@endsection

@endsection
