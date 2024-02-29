<?php

namespace App\Http\Controllers;

use HashFormatRupiah;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() 
    {
        $total_produk = Produk::count();
        $total_pelanggan = Pelanggan::count();
        $total_stok = Produk::sum('stok');
        $total_total_harga = Penjualan::sum('total_harga');     
        $total_hrg = "Rp". number_format($total_total_harga, 2, ',' , '.');     

        return view('dahsboard.index'
        ,
        [
            'total_produk' => $total_produk,
            'total_pelanggan' => $total_pelanggan,
            'total_stok' => $total_stok,
            'total_total_harga' => $total_total_harga,
            'total_hrg' => $total_hrg
        ]
    );
    }
}
