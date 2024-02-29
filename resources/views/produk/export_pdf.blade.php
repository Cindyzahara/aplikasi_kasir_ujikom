<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

        table tr th {
            font-weight: bold;
            text-align: center;
            background: #f4f4f4;
        }
    </style>
    <center>
        <h4>DATA BARANG</h4>
        <p>Waktu Export : {{ date('d-m-Y H:i') }}</p> <!-- SET KAPAN USER EXPORT -->
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th class="wd-5p border-bottom-0" style="text-align:center">No</th>
                <th class="wd-20p border-bottom-0" style="text-align:center">Nama Produk</th>
                <th class="wd-15p border-bottom-0" style="text-align:center">Harga</th>
                <th class="wd-10p border-bottom-0" style="text-align:center">Stok </th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp <!-- MEMBUAT VAR $NO DENGAN NILAI 1 -->
            @if (count($data))
                @foreach ($data as $dt)
                    <!-- MEMBUAT PERULANGAN UNTUK MENAMPILKAN HASIL DARI DB -->
                    <tr>
                        <td style="text-align:center">{{ $loop->iteration }}</td>
                        <td style="text-align:center">{{ $dt->nama_produk }}</td>
                        <td style="text-align:center">{{ $dt->formatRupiah('harga') }}</td>
                        <td style="text-align:center">{{ $dt->stok }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

</body>

</html>