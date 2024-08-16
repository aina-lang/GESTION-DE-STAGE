@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Etudiants</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('student/list') }}">Etudiants</a></li>
                                <li class="breadcrumb-item active">Touts les etudiants</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="student-group-form">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="rechercher par ID ...">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="rechercher par telephone ...">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="rechercher par telephone ...">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="search-student-btn">
                            <button type="btn" class="btn btn-primary">rechercher</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body pb-0">
                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="page-header">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h3 class="page-title">Etudiants</h3>
                                            </div>
                                            <div class="col-auto text-end float-end ms-auto download-grp">
                                                <a href="{{ route('student/list') }}" class="btn btn-outline-gray me-2 "><i
                                                        class="feather-list"></i></a>
                                                <a href="{{ route('student/grid') }}"
                                                    class="btn btn-outline-gray me-2 active"><i
                                                        class="feather-grid"></i></a>
                                                <a href="#" class="btn btn-outline-primary me-2"><i
                                                        class="fas fa-download"></i> Telecharger</a>
                                                <a href="{{ route('student/add/page') }}" class="btn btn-primary"><i
                                                        class="fas fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="student-pro-list">
                                <div
                                    style="display: flex; justify-content: space-between; display: grid; grid-template-columns: repeat(4, 1fr);grid-gap:10px;">

                                    @foreach ($studentList as $key => $list)
                                        <div class=" h-full card overflow-hidden">

                                            <!-- Image -->
                                            {{-- <a href="{{ url('student/profile/' . $list->id) }}"
                                                style="height:192px;width:100%; "> --}}
                                            <img class="h-48 w-full"
                                                src="{{ Storage::url('/student-photos/' . $list->upload) }}" height="192"
                                                alt="Course 01">
                                            {{-- </a> --}}

                                            <!-- Card Content -->
                                            <div class="flex-1 flex flex-col p-6 card-body">
                                                <!-- Card body -->
                                                <div class="flex-1 text-center">
                                                    <!-- Header -->
                                                    <header class="mb-2">
                                                        <span>
                                                            <a class="text-slate-900 focus-visible:outline-none focus-visible:ring focus-visible:ring-indigo-300"
                                                                href="{{ url('student/profile/' . $list->id) }}">
                                                                {{ $list->Nom }} {{ $list->Prenoms }}
                                                            </a>
                                                        </span>
                                                    </header>
                                                </div>
                                                <!-- Card footer -->
                                                <div class="d-flex flex text-center space-x-2 mt-4">
                                                    <a href="{{ url('student/edit/' . $list->id) }}"
                                                        class="btn btn-sm bg-danger-light">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    <a class="btn btn-sm bg-danger-light student_delete"
                                                        data-id="{{ $list->id }}" data-avatar="{{ $list->upload }}"
                                                        data-bs-toggle="modal" data-bs-target="#studentUser">
                                                        <i class="feather-trash-2 me-1"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
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
