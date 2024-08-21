{{-- resources/views/department/list-departments.blade.php --}}

@extends('layouts.master')

@section('content')
    {{-- Message --}}
    {!! Toastr::message() !!}

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Départements</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                            <li class="breadcrumb-item active">Départements</li>
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
                                        <h3 class="page-title">Liste des Départements</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        {{-- <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Télécharger</a> --}}
                                        <a href="{{ route('departments.add') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter</a>
                                    </div>
                                </div>
                            </div>

                            <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        <th>Nom</th>
                                        <th>Description</th>
                                        <th>Nombre d'Étudiants</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departments as $department)
                                        <tr>
                                            <td>
                                                <h2><a href="{{ route('departments.show', $department->id) }}">{{ $department->name }}</a></h2>
                                            </td>
                                            <td>{{ $department->description }}</td>
                                            <td>{{ $department->students()->count() }}</td>
                                            <td class="text-end">
                                                <div class="actions">
                                                    <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-sm bg-warning-light me-2">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm bg-danger-light department_delete" data-bs-toggle="modal" data-bs-target="#departmentDelete" data-id="{{ $department->id }}">
                                                        <i class="feather-trash-2"></i>
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

    {{-- Modal suppression département --}}
    <div class="modal fade" id="departmentDelete" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header pb-0 border-bottom-0 justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('departments.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="delete-wrap text-center">
                            <div class="del-icon">
                                <i class="feather-trash-2"></i>
                            </div>
                            <input type="hidden" name="id" class="department_id" value="">
                            <h2>Êtes-vous sûr de vouloir supprimer ce département ?</h2>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-success me-2">Oui</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Non</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@section('script')
    {{-- JS pour modal suppression --}}
    <script>
        $(document).on('click', '.department_delete', function() {
            var departmentId = $(this).data('id');
            $('.department_id').val(departmentId);
        });
    </script>
@endsection
@endsection
