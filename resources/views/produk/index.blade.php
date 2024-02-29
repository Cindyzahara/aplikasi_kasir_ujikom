@extends('layout.main')
<title>Produk</title>
@section('content')

<div class="main-container container-fluid">

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div>
            <h4 class="content-title mb-2">Data Barang</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a   href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Produk</li>
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
                    {{-- <h1 class="card-title">Produk </h1> --}}
                    <div class="d-flex my-auto btn-list justify-content-end">            
                        <a class="modal-effect btn btn-primary" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#modaldemo8">Tambah Data</a>
                        <a class="btn ripple btn-info" data-bs-target="#modaldemo1" data-bs-toggle="modal" href="">Import Excel</a>
                        <a href="{{ route('export_excel_produk') }}" class="btn btn-success">Export Excel</a>
                        <a href="{{ route('export_pdf_produk') }}" class="btn btn-danger">Export PDF</a>
                    </div>
                    @include('_component.pesan') 
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table border-top-0 table-bordered table-striped text-nowrap border-bottom" id="basic-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-5p border-bottom-0" style="text-align:center">No</th>
                                    <th class="wd-20p border-bottom-0" style="text-align:center">Nama Produk</th>
                                    <th class="wd-15p border-bottom-0" style="text-align:center">Harga</th>
                                    <th class="wd-10p border-bottom-0" style="text-align:center">Stok </th>
                                    <th class="wd-10p border-bottom-0" style="text-align:center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produk as $dt)
                                    <tr>
                                        <td style="text-align:center">{{ $loop->iteration }}</td>
                                        <td style="text-align:center">{{ $dt->nama_produk }}</td>
                                        <td style="text-align:center">{{ $dt->formatRupiah('harga') }}</td>
                                        <td style="text-align:center">{{ $dt->stok }}</td>
                                        <td style="text-align:center">
                                            <a class="modal-effect btn btn-warning" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#modaldemo8{{ $dt->id }}" title="Edit"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('produk.destroy', $dt->id) }}" method="post" onsubmit="return confirm('Apakah adna yakin akan mengahpus data ini')" class="d-inline">
                                                @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @include('produk.modal_edit')
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

@include('produk.modal_create')


@include('produk.modal_import')

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