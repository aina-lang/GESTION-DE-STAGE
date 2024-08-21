@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Étudiants</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('student/list') }}">Étudiants</a></li>
                                <li class="breadcrumb-item active">Tous les étudiants</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">
                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Étudiants</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="{{ route('student/add/page') }}" class="btn btn-primary"><i
                                                class="fas fa-plus"></i>Ajouter</a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>Profil</th>
                                            <th>Nom</th>
                                            <th>Prénoms</th>
                                            <th>Genre</th>
                                            <th>Âge</th>
                                            <th>Adresse</th>
                                            <th>E-Mail</th>
                                            <th>Niveau</th>
                                            <th>Téléphone</th>
                                            <th>Matricule</th>
                                            <th>Département</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($studentList as $key => $list)
                                            <tr>
                                                <td class="rounded-circle">
                                                    <a class="avatar avatar-sm me-2"
                                                        href="{{ url('student/profile/' . $list->id) }}">
                                                        <img class="avatar-img rounded-circle"
                                                            src="{{ asset('storage/student-photos/' . $list->upload) }}"
                                                            alt="{{ $list->Nom }}">
                                                    </a>
                                                </td>
                                                <td>{{ $list->Nom }}</td>
                                                <td>{{ $list->Prenoms }}</td>
                                                <td>{{ $list->Genre }}</td>
                                                <td>{{ $list->Age }}</td>
                                                <td>{{ $list->Adresse }}</td>
                                                <td>{{ $list->email }}</td>
                                                <td>{{ $list->Niveau }}</td>
                                                <td>{{ $list->Telephone }}</td>
                                                <td>{{ $list->matricule }}</td>
                                                <td>{{ $list->department->name }}</td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a href="{{ url('student/edit/' . $list->id) }}"
                                                            class="btn btn-sm bg-danger-light">
                                                            <i class="feather-edit"></i>
                                                        </a>
                                                        <a class="btn btn-sm bg-danger-light student_delete"
                                                            data-id="{{ $list->id }}"
                                                            data-avatar="{{ $list->upload }}" data-bs-toggle="modal"
                                                            data-bs-target="#studentUser">
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
    {{-- modal student delete --}}
    <div class="modal fade contentmodal" id="studentUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header pb-0 border-bottom-0  justify-content-end">
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('student/delete') }}" method="POST">
                        @csrf
                        <div class="delete-wrap text-center">
                            <div class="del-icon">
                                <i class="feather-x-circle"></i>
                            </div>
                            <input type="hidden" name="id" class="e_id" value="">
                            <input type="hidden" name="avatar" class="e_avatar" value="">
                            <h2>Vous êtes sûr de supprimer?</h2>
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
    {{-- delete js --}}
    <script>
        $(document).on('click', '.student_delete', function() {
            $('.e_id').val($(this).data('id'));
            $('.e_avatar').val($(this).data('avatar'));
            console.log($(this).data('id'));
        });
    </script>
@endsection
@endsection
