<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PenggunaExportView;
use Maatwebsite\Excel\Facades\Excel;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('data_pengguna.index', compact('user'));
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
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'role' => 'required',
        ],[
            'username.required' => 'Username tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 6 karakter',
            'nama_lengkap.required' => 'Nama Lengkap tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'role.required' => 'Role tidak boleh kosong',
        ]);

        $user = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'role' => $request->role
        ];
        // dd($data);
        User::create($user);
        return back()->with('success','Data berhasil disimpan');
        // User::create($user);
        // return redirect()->route('data_pengguna.index')-with('success', 'Data berhasi di simpan');
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
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'role' => 'required',
        ],[
            'username.required' => 'Username tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 6 karakter',
            'nama_lengkap.required' => 'Nama Lengkap tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'role.required' => 'Role tidak boleh kosong',
        ]);

        $user = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'role' => $request->role
        ];
        // dd($data);
        User::find($id)->update($user);
        return redirect()->route('data_pengguna.index')->with('success', 'Data Berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('data_pengguna.index')->with('success', 'Data berhasil di hapus');
    }

    //CLASS EXPORT EXCEL PENGGUNA
    public function export_excel(Request $request)
    {
        //QUERY, MENGAMBIL DATA DARI DATABASE
        $data = User::select('*');
        $data = $data->get();

        // Pass parameters to the export class
        $export = new PenggunaExportView($data);
        
        // SET FILE NAME
        $filename = date('YmdHis') . '_data_pengguna';
        
        // Download the Excel file
        return Excel::download($export, $filename . '.xlsx');
    }

    
    // CLASS EXPORT PDF DATA BARANG 
    public function export_pdf() 
    {
        // mengurutkan sesuai abjad 
        $data = User::orderBy('email', 'asc');
        
        $data = $data->get();

        // Meneruskan parameter ke tampilan ekspor
        $pdf = PDF::loadview('data_pengguna.export_pdf', ['data'=>$data]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        // UNTUK MENENTUKAN NAMA FILE
        $filename = date('YmdHis') . '_data_pengguna';
        // untuk mendownload file pdf
        return $pdf->download($filename.'.pdf');
    }
}   