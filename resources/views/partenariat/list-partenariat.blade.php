@extends('layouts.master')

@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Liste des Partenaires</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
                            <li class="breadcrumb-item active">Liste des Partenaires</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- <div class="student-group-form">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Rechercher par ID ...">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Rechercher par Nom ...">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Rechercher par Secteur ...">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="search-student-btn">
                            <button type="button" class="btn btn-primary">Rechercher</button>
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
                                        <h3 class="page-title">Liste des Partenaires</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        {{-- <a href="#" class="btn btn-outline-primary me-2"><i
                                                class="fas fa-download"></i> Télécharger</a> --}}
                                        <a href="{{ route('partenariats.add') }}" class="btn btn-primary"><i
                                                class="fas fa-plus"></i>Ajouter</a>
                                    </div>
                                </div>
                            </div>

                            <table
                                class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        {{-- <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th> --}}
                                        {{-- <th>ID</th> --}}
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Adresse</th>
                                        <th>Secteur</th>
                                        <th class="">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listPartenaires as $partenaire)
                                        <tr>
                                            {{-- <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="{{ $partenaire->id }}">
                                            </div>
                                        </td> --}}
                                            {{-- <td>{{ $partenaire->id }}</td> --}}
                                            <td>
                                                <h2>
                                                    <a>{{ $partenaire->nom }}</a>
                                                </h2>
                                            </td>
                                            <td>{{ $partenaire->email }}</td>
                                            <td>{{ $partenaire->telephone }}</td>
                                            <td>{{ $partenaire->adresse }}</td>
                                            <td>{{ $partenaire->secteur }}</td>
                                            <td class="text-end">
                                                <div class="actions">
                                                    {{-- <a href="{{ route('partenariats.show', $partenaire->id) }}" class="btn btn-sm bg-success-light me-2">
                                                    <i class="feather-eye"></i>
                                                </a> --}}
                                                    <a href="{{ route('partenariats.edit', $partenaire->id) }}"
                                                        class="btn btn-sm bg-danger-light">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    <a class="btn btn-sm bg-danger-light partenariat_delete"
                                                        data-id="{{ $partenaire->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#partenariatDelete">
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



    {{-- Modal suppression enseignant --}}
    <div class="modal fade" id="partenariatDelete" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header pb-0 border-bottom-0 justify-content-end">
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Fermer"><i
                            class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('partenariats.delete') }}" method="POST">

                        @csrf
                        @method('POST')
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
        $(document).on('click', '.partenariat_delete', function() {
            var _this = $(this).data('id');
            $('.e_id').val(_this);
        });
    </script>
@endsection

@endsection
