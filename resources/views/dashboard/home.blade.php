@extends('layouts.master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Tableau de bord</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                                <li class="breadcrumb-item active">Tableau de bord</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- Section Étudiants --}}
                <div class="col-12 col-lg-6 col-xl-3 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Tous les Étudiants</h6>
                                    <h3>{{ $studentCount }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/student-icon-01.svg') }}" alt="Icône Étudiant">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Section Partenaires --}}
                <div class="col-12 col-lg-6 col-xl-3 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Tous les Partenaires</h6>
                                    <h3>{{ $partnerCount }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/student-icon-01.svg') }}" alt="Icône Étudiant">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Section Stages --}}
                <div class="col-12 col-lg-6 col-xl-3 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Tous les Stages</h6>
                                    <h3>{{ $stageCount }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/student-icon-01.svg') }}" alt="Icône Étudiant">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Section Superviseurs --}}
                <div class="col-12 col-lg-6 col-xl-3 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Tous les Superviseurs</h6>
                                    <h3>{{ $supervisorCount }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ URL::to('assets/img/icons/student-icon-01.svg') }}" alt="Icône Étudiant">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="card flex-fill comman-shadow">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title">Vue d'ensemble des Stagiaires et Étudiants</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="activity-chart"></canvas>
                </div>
            </div> --}}

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('activity-chart').getContext('2d');

            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Étudiants', 'Partenaires', 'Stages', 'Superviseurs'],
                    datasets: [{
                        label: 'Nombre',
                        data: [
                            {{ $studentCount }},
                            {{ $partnerCount }},
                            {{ $stageCount }},
                            {{ $supervisorCount }}
                        ],
                        backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#F1C40F'],
                        borderColor: ['#C70039', '#28B463', '#1F77B4', '#F39C12'],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
