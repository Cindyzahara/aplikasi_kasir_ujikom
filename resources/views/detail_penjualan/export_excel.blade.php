{{-- <table>
    <tbody>
        <tr>
            <td colspan="9" style="font-weight:bold;text-align:center">DATA BUKU</td>
        </tr>
        <tr>
            <td colspan="9" style="font-weight:bold;text-align:center">Waktu Export : {{date('d-m-Y H:i')}}</td>
        </tr>
    </tbody>
</table> --}}
<table>
    <thead>
    <tr>
        <th style="font-weight:bold;text-align:center;background:#f4f4f4;border:1px solid #000000;">No</th> <!-- kolom A -->
        <th style="font-weight:bold;text-align:center;background:#f4f4f4;border:1px solid #000000;">Nama Pelanggan</th> <!-- kolom B -->
        <th style="font-weight:bold;text-align:center;background:#f4f4f4;border:1px solid #000000;">Produk</th> <!-- kolom C -->
        <th style="font-weight:bold;text-align:center;background:#f4f4f4;border:1px solid #000000;">Jumlah Produk</th> <!-- kolom D -->
        <th style="font-weight:bold;text-align:center;background:#f4f4f4;border:1px solid #000000;">Sub Total</th> <!-- kolom E -->
    </tr>
    </thead>
    <tbody>
    @php $no=1; @endphp
    @if(count($data))
    @foreach($data as $dt)
        <tr>
            <td style="text-align:center">{{ $loop->iteration }}</td>
            <td style="text-align:center">{{ $dt->penjualan->pelanggan->nama_pelanggan }}</td>
            <td style="text-align:center">{{ $dt->produk->nama_produk }}</td>
            <td style="text-align:center">{{ $dt->jumlah_produk }}</td>
            <td style="text-align:center">{{ $dt->formatRupiah('subtotal')}}</td>
        </tr>
    @endforeach
    @endif
    </tbody>
</table>