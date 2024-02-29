@extends('layout.main')
<title>Data Pengguna</title>
@section('content')

<div class="main-container container-fluid">

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div>
            <h4 class="content-title mb-2">DATA PENGGUNA</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Data Pengguna</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- /breadcrumb -->

    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" >
                    {{-- <h3 class="card-title">Data Pelanggan</h3> --}}
                    <div class="d-flex my-auto btn-list justify-content-end">            
                        <a class="modal-effect btn btn-primary" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#modaldemo8"> Tambah Data </a>
                        <a href="{{ route('export_excel_pengguna') }}" class="btn btn-success">Export Excel</a>
                        <a href="{{ route('export_pdf_pengguna') }}" class="btn btn-danger">Export PDF</a>
                    </div>
                    @include('_component.pesan') 
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table border-top-0 table-bordered table-striped text-nowrap border-bottom" id="basic-datatable">
                            <thead>
                                <tr>
                                    <th width="20px">No</th>
                                    <th style="text-align:center">Username</th>
                                    <th style="text-align:center">Email</th>
                                    <th style="text-align:center">Nama Lengkap</th>
                                    <th style="text-align:center">Alamat</th>
                                    <th style="text-align:center">Hak Akses</th>
                                    <th style="text-align:center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $dt)
                                    <tr>
                                        <td width="20px">{{ $loop->iteration }}</td>
                                        <td style="text-align:center">{{ $dt->username??'' }}</td>
                                        <td style="text-align:center">{{ $dt->email??'' }}</td>
                                        <td style="text-align:center">{{ $dt->nama_lengkap??'' }}</td>
                                        <td style="text-align:center">{{ $dt->alamat??'' }}</td>
                                        <td style="text-align:center">{{ $dt->role??'' }}</td>
                                        <td>
                                            <a class="modal-effect btn btn-warning" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#modaldemo8{{ $dt->id }}" title="Edit"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('data_pengguna.destroy', $dt->id) }}" method="post" onsubmit="return confirm('Apakah adna yakin akan mengahpus data ini')" class="d-inline">
                                                @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @include('data_pengguna.modal_edit')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
</div>

@include('data_pengguna.modal_create')

  <script>
            $(function() {
                // formelement
                $('.select2').select2({ width: 'resolve' });
                
                // init datatable.
                $('#tbl_list').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": false,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });

            });
</script>

@endsection