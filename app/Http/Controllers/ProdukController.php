<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Produk;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ProdukExportView;
use App\Imports\ImportProdukClass;
use Maatwebsite\Excel\Facades\Excel;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::all();
        return view('produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDASI UNTUK INPUT DATA PRODUK
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required'
        ],[
            'nama_produk.required' => 'Nama produk  wajib di isi',
            'harga.required' => 'Harga wajib di isi',
            'stok.required' => 'Stok wajib di isi'
        ]);

        $produk = [
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok
        ];

        // dd($produk);  // untuk mengecek apakah data yg dimasukan nilainya ada atau null
        Produk::create($produk);
        return redirect()->route('produk.index')->with('success', 'Data berhasil di simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // UPDATE DATA PRODUK 
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ],
        [
            'nama_produk.required' => 'Nama produk  wajib di isi',
            'harga.required' => 'Harga wajib di isi',
            'stok.required' => 'Stok wajib di isi'
        ]);

        $produk = [
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok
        ];

        Produk::find($id)->update($produk);
        return redirect()->route('produk.index')->with('success', 'Data Berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Hapus Data Produk
        // Produk::find($id)->delete();
        return redirect()->route('produk.index')->with('info', 'Data tidak dapat dihapus!!');
    }

    //CLASS EXPORT EXCEL PRODUK
    public function export_excel(Request $request)
    {
        //QUERY, MENGAMBIL DATA DARI DATABASE
        $data = Produk::select('*');
        $data = $data->get();

        // Pass parameters to the export class
        $export = new ProdukExportView($data);
        
        // SET FILE NAME
        $filename = date('YmdHis') . '_produk';
        
        // Download the Excel file
        return Excel::download($export, $filename . '.xlsx');
    }

    // CLASS EXPORT PDF DATA BARANG 
    public function export_pdf() 
    {
        // mengurutkan sesuai abjad 
        $data = Produk::orderBy('nama_produk', 'asc');
        
        $data = $data->get();

        // Meneruskan parameter ke tampilan ekspor
        $pdf = PDF::loadview('produk.export_pdf', ['data'=>$data]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        // UNTUK MENENTUKAN NAMA FILE
        $filename = date('YmdHis') . '_produk';
        // untuk mendownload file pdf
        return $pdf->download($filename.'.pdf');
    }

    // cLASS IMPORT EXCEL PRODUK
    public function import_excel(Request $request)
    {
            //DECLARE REQUEST
        $file = $request->file('file'); 

        //VALIDATION FORM
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        try {
            if($file){
                // IMPORT DATA
                $import = new ImportProdukClass;
                Excel::import($import, $file);

                // SUCCESS
                $notimportlist="";
                if ($import->listgagal) {
                    $notimportlist.="<hr> Not Register : <br> {$import->listgagal}";
                }
                return back()
                ->with('success', 'Import Data berhasil,<br>
                Size '.$file->getSize().', File extention '.$file->extension().',
                Insert '.$import->insert.' data, Update '.$import->edit.' data,
                Failed '.$import->gagal.' data, <br> '.$notimportlist.'');

            } else {
                // ERROR
                return back()
                ->withInput()
                ->with('error','Gagal memproses!');
            }
            
        }
        catch(Exception $e){
            // ERROR
            return back()
            ->withInput()
            ->with('error','Gagal memproses!');
        }
    }
}
