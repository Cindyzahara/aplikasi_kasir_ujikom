@extends('layout.main')
<title>Dashboard</title>
@section('content')

	<!-- container -->
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Hi, welcome back @auth {{ auth()->user()->username }} @endauth!</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a   href="javascript:void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Project</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- main-content-body -->
        <div class="main-content-body">
            <div class="row row-sm">
                <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12">
                    <div class="card overflow-hidden project-card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="my-auto">
                                    <div class="me-4 ht-60 wd-60 my-auto primary">
                                        <img src="{{ asset('') }}images/svg/box.svg" width="100px" height="100px" class="ht-40 wd-60">
                                    </div>
                                </div>
                                <div class="project-content">
                                    <h6 class="card-title">Data Barang</h6>
                                    <ul>
                                        <li>
                                            <strong>Total</strong>
                                            <span>{{ $total_produk }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12">
                    <div class="card  overflow-hidden project-card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="my-auto">
                                    <div class="me-4 ht-60 wd-60 my-auto warning">
                                        <img src="{{ asset('') }}images/svg/tags-label.svg" width="100px" height="100px" class="ht-40 wd-60">
                                    </div>
                                </div>
                                <div class="project-content">
                                    <h6 class="card-title">Stok Barang</h6>
                                    <ul>
                                        <li>
                                            <strong>Total</strong>
                                            <span>{{ $total_stok }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12">
                    <div class="card  overflow-hidden project-card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="my-auto">
                                    <div class="me-4 ht-60 wd-60 my-auto success">
                                        <img src="{{ asset('') }}images/svg/agenda.svg" width="100px" height="100px" class="ht-40 wd-60">
                                    </div>
                                </div>
                                <div class="project-content">
                                    <h6 class="card-title">Data Keuangan</h6>
                                    <ul>
                                        <li>
                                            <strong>Total</strong>
                                            <span>{{ $total_hrg }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12">
                    <div class="card  overflow-hidden project-card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="my-auto">
                                    <div class="me-4 ht-60 wd-60 my-auto danger">
                                        <img src="{{ asset('') }}images/svg/akun.svg" width="100px" height="100px" class="ht-40 wd-60">
                                    </div>
                                </div>
                                <div class="project-content">
                                    <h6 class="card-title">Data Pelanggan</h6>
                                    <ul>
                                        <li>
                                            <strong>Total</strong>
                                            <span>{{ $total_pelanggan }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

   
    <!-- /container -->
    
@endsection