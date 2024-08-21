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

            {{-- <div class="content container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="departmentPieChart"></canvas>
                    </div>
                    <div class="col-md-6">
                        <canvas id="partnerBarChart"></canvas>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>

    <script src="{{ URL::to('assets/plugins/chartjs/chart.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var departmentCtx = document.getElementById('departmentPieChart').getContext('2d');
            var partnerCtx = document.getElementById('partnerBarChart').getContext('2d');

            // Préparer les données pour le graphique par département
            var departmentLabels = {!! json_encode($stagesByDepartment->keys()->toArray()) !!};
            var departmentData = {!! json_encode($stagesByDepartment->map->count()->values()->toArray()) !!};

            console.log({!! json_encode($stagesByDepartment) !!});
            var departmentChart = new Chart(departmentCtx, {
                type: 'pie',
                data: {
                    labels: departmentLabels,
                    datasets: [{
                        data: departmentData,
                        backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#F1C40F'],
                        borderColor: ['#C70039', '#28B463', '#1F77B4', '#F39C12'],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    }
                }
            });

            // Préparer les données pour le graphique en barres par partenaire
            var partnerLabels = {!! json_encode($stagesByPartner->keys()->toArray()) !!};
            var partnerData = {!! json_encode($stagesByPartner->map->count()->values()->toArray()) !!};

            var partnerChart = new Chart(partnerCtx, {
                type: 'bar',
                data: {
                    labels: partnerLabels,
                    datasets: [{
                        label: 'Nombre de stages',
                        data: partnerData,
                        backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#F1C40F'],
                        borderColor: ['#C70039', '#28B463', '#1F77B4', '#F39C12'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
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
