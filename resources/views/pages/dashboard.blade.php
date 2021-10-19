@extends('layouts.dashboard')
@section('title', 'SPPD')

@section('content')
    <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading d-flex justify-content-between align-items-center">
                <h3>Data Statistik Penduduk</h3>
                <div class="text-wrap" style="width: 170px; line-height: 50%;">
                    <h6>{{ Auth::user()->name }}</h6>
                    <p>{{ Auth::user()->email }}</p>
                    @if(Auth::user()->role == 'Super Admin')
                        <div class="badge bg-success">{{ Auth::user()->role }}</div>
                    @elseif(Auth::user()->role == 'Admin')
                        <div class="badge bg-danger">{{ Auth::user()->role }}</div>
                    @elseif(Auth::user()->role == 'Watcher')
                        <div class="badge bg-primary">{{ Auth::user()->role }}</div>
                    @endif
                </div>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">

                        <div class="row" id="count">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldUser"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Penduduk</h6>
                                                <h6 class="font-extrabold mb-0 counter-value" data-count="{{ $residents->count() }}">0</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Kelahiran</h6>
                                                <h6 class="font-extrabold mb-0 counter-value" data-count="{{ $births->count() }}">0</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Kematian</h6>
                                                <h6 class="font-extrabold mb-0 counter-value" data-count="{{ $dies->count() }}">0</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">User</h6>
                                                <h6 class="font-extrabold mb-0 counter-value" data-count="{{ $users->count() }}">0</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Pertumbuhan Penduduk Desa</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart-profile-visit"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-xl-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Statistik Data</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart-visitors-profile"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-xl-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Update Data Penduduk Baru</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-lg">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>NIK</th>
                                                        <th>Jenis Kelamin</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($update as $up)
                                                    <tr>
                                                        <td class="col-3">
                                                            <div class="d-flex align-items-center">
                                                                <p class="font-bold ms-3 mb-0">{{ $up->name }}</p>
                                                            </div>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class=" mb-0">{{ $up->NIK }}</p>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class=" mb-0">{{ $up->gender }}</p>
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

                        <div class="row">
                            <div class="col-12 col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Statistik Data Penduduk</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="d-flex align-items-center">
                                                    <svg class="bi text-primary" width="32" height="32" fill="blue"
                                                        style="width:10px">
                                                        <use
                                                            xlink:href="/dist/assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill" />
                                                    </svg>
                                                    <h5 class="mb-0 ms-3">Penduduk Tetap</h5>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="mb-0">{{ $tetaps->count() }}</h5>
                                            </div>
                                            <div class="col-12">
                                                <div id="chart-europe"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="d-flex align-items-center">
                                                    <svg class="bi text-success" width="32" height="32" fill="blue"
                                                        style="width:10px">
                                                        <use
                                                            xlink:href="/dist/assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill" />
                                                    </svg>
                                                    <h5 class="mb-0 ms-3">Penduduk Pindah</h5>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="mb-0">{{ $transfers->count() }}</h5>
                                            </div>
                                            <div class="col-12">
                                                <div id="chart-america"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="d-flex align-items-center">
                                                    <svg class="bi text-danger" width="32" height="32" fill="blue"
                                                        style="width:10px">
                                                        <use
                                                            xlink:href="/dist/assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill" />
                                                    </svg>
                                                    <h5 class="mb-0 ms-3">Penduduk Datang</h5>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="mb-0">{{ $comes->count() }}</h5>
                                            </div>
                                            <div class="col-12">
                                                <div id="chart-indonesia"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
@endsection

@push('afterScript')
    <script>
        $(document).ready(function() {
            var a = 0;
                var cTop = $('#count').offset().top - window.innerHeight,
                    scroll = $(window).scrollTop();
                if (a == 0 && scroll > cTop ) {
                    $('.counter-value').each(function() {
                        var $this     = $(this),
                            countTo = $this.attr('data-count');
                        $({
                            countNum: $this.text()
                        }).animate({
                            countNum: countTo
                        },
                        {
                            duration: 1000,
                            easing: 'swing',
                            step: function() {
                                if($this.hasClass('with-plus')) {
                                    $this.text(Math.floor(this.countNum) + '+');
                                } else {
                                    $this.text(Math.floor(this.countNum));
                                }
                            },
                            complete: function() {
                                if($this.hasClass('with-plus')) {
                                    $this.text(this.countNum + '+');
                                } else {
                                    $this.text(this.countNum);
                                }
                            }
                        });
                    });
                    a = 1;
                }
        })
    </script>
    <script>
        var optionsProfileVisit = {
            annotations: {
                position: "back",
            },
            dataLabels: {
                enabled: false,
            },
            chart: {
                type: "bar",
                height: 300,
            },
            fill: {
                opacity: 1,
            },
            plotOptions: {},
            series: [
                {
                    name: "Penduduk",
                    data: [{{ $month['Jan'] }}, {{ $month['Feb'] }}, {{ $month['Mar'] }}, {{ $month['Apr'] }}, {{ $month['May'] }}, {{ $month['Jun'] }}, {{ $month['Jul'] }},  {{ $month['Aug'] }},  {{ $month['Sep'] }},  {{ $month['Oct'] }},  {{ $month['Nov'] }},  {{ $month['Dec'] }}],
                },
            ],
            colors: "#435ebe",
            xaxis: {
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
            },
        };
        let optionsVisitorsProfile = {
            series: [{{ $births->count() }}, {{ $dies->count() }}],
            labels: ["Kelahiran", "Kematian"],
            colors: ["#435ebe", "#55c6e8"],
            chart: {
                type: "donut",
                width: "100%",
                height: "350px",
            },
            legend: {
                position: "bottom",
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: "30%",
                    },
                },
            },
        };

        var optionsEurope = {
            series: [
                {
                    name: "Jumlah Penduduk Tetap",
                    data: [{{ $penduduk_tetap['Jan'] }}, {{ $penduduk_tetap['Feb'] }}, {{ $penduduk_tetap['Mar'] }}, {{ $penduduk_tetap['Apr'] }}, {{ $penduduk_tetap['May'] }}, {{ $penduduk_tetap['Jun'] }}, {{ $penduduk_tetap['Jul'] }},  {{ $penduduk_tetap['Aug'] }},  {{ $penduduk_tetap['Sep'] }},  {{ $penduduk_tetap['Oct'] }},  {{ $penduduk_tetap['Nov'] }},  {{ $penduduk_tetap['Dec'] }}],
                },
            ],
            chart: {
                height: 80,
                type: "area",
                toolbar: {
                    show: false,
                },
            },
            colors: ["#5350e9"],
            stroke: {
                width: 2,
            },
            grid: {
                show: true,
            },
            dataLabels: {
                enabled: true,
            },
            xaxis: {
                type: "month",
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                },
            },
            show: false,
            yaxis: {
                labels: {
                    show: false,
                },
            },
            tooltip: {
                x: {
                    format: "dd/MM/yy HH:mm",
                },
            },
        };

        let optionsAmerica = {
            series: [
                {
                    name: "Jumlah Penduduk Pindah",
                    data: [{{ $penduduk_pindah['Jan'] }}, {{ $penduduk_pindah['Feb'] }}, {{ $penduduk_pindah['Mar'] }}, {{ $penduduk_pindah['Apr'] }}, {{ $penduduk_pindah['May'] }}, {{ $penduduk_pindah['Jun'] }}, {{ $penduduk_pindah['Jul'] }},  {{ $penduduk_pindah['Aug'] }},  {{ $penduduk_pindah['Sep'] }},  {{ $penduduk_pindah['Oct'] }},  {{ $penduduk_pindah['Nov'] }},  {{ $penduduk_pindah['Dec'] }}],
                },
            ],
            chart: {
                height: 80,
                type: "area",
                toolbar: {
                    show: false,
                },
            },
            stroke: {
                width: 2,
            },
            grid: {
                show: true,
            },
            dataLabels: {
                enabled: true,
            },
            xaxis: {
                type: "month",
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                },
            },
            show: false,
            yaxis: {
                labels: {
                    show: false,
                },
            },
            tooltip: {
                x: {
                    format: "dd/MM/yy HH:mm",
                },
            },
            colors: ["#008b75"],
        };
        let optionsIndonesia = {
            series: [
                {
                    name: "Jumlah Penduduk Datang",
                    data: [{{ $penduduk_datang['Jan'] }}, {{ $penduduk_datang['Feb'] }}, {{ $penduduk_datang['Mar'] }}, {{ $penduduk_datang['Apr'] }}, {{ $penduduk_datang['May'] }}, {{ $penduduk_datang['Jun'] }}, {{ $penduduk_datang['Jul'] }},  {{ $penduduk_datang['Aug'] }},  {{ $penduduk_datang['Sep'] }},  {{ $penduduk_datang['Oct'] }},  {{ $penduduk_datang['Nov'] }},  {{ $penduduk_datang['Dec'] }}],
                },
            ],
            chart: {
                height: 80,
                type: "area",
                toolbar: {
                    show: false,
                },
            },
            stroke: {
                width: 2,
            },
            grid: {
                show: true,
            },
            dataLabels: {
                enabled: true,
            },
            xaxis: {
                type: "month",
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                },
            },
            show: false,
            yaxis: {
                labels: {
                    show: false,
                },
            },
            tooltip: {
                x: {
                    format: "dd/MM/yy HH:mm",
                },
            },
            colors: ["#dc3545"],
        };

        var chartProfileVisit = new ApexCharts(
            document.querySelector("#chart-profile-visit"),
            optionsProfileVisit
        );
        var chartVisitorsProfile = new ApexCharts(
            document.getElementById("chart-visitors-profile"),
            optionsVisitorsProfile
        );
        var chartEurope = new ApexCharts(
            document.querySelector("#chart-europe"),
            optionsEurope
        );
        var chartAmerica = new ApexCharts(
            document.querySelector("#chart-america"),
            optionsAmerica
        );
        var chartIndonesia = new ApexCharts(
            document.querySelector("#chart-indonesia"),
            optionsIndonesia
        );

        chartIndonesia.render();
        chartAmerica.render();
        chartEurope.render();
        chartProfileVisit.render();
        chartVisitorsProfile.render();
    </script>
@endpush
