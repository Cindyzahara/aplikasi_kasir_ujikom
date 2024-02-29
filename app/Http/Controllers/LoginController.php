<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // CLASS LOGIN
    public function login()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $validasi = $request->validate([
            'email' => 'required',
            'password' => 'required|min:5'
        ],[
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 5 karakter'
        ]);

        if (Auth::attempt($validasi)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard.index')->with('success', 'Berhasil Login');
        }
        return back()->withErrors('Email atau password yang di masukan tidak sesuai');
    }

    // CLASS LOGOUT 
    public function logout() 
    {
        Auth::logout();
        return redirect()->route('login');
    }

    // CLASS REGISTRASI
    public function registrasi()
    {
        return view('auth.registrasi');
    }

    public function auth_regis(Request $request)
    {
        // MENYIMPAN DATA SEMENTARA
        Session::flash('username', $request->username);
        Session::flash('email', $request->email);
        Session::flash('password', $request->password);
        Session::flash('nama_lengkap', $request->nama_lengkap);
        Session::flash('alamat', $request->alamat);
        Session::flash('role', $request->role);

        // PROSES VALIDASI 
        $request->validate(
            [
                'username' => 'required',
                'email' => 'required',
                'password' => 'required|min:5',
                'nama_lengkap' => 'required|max:30',
                'alamat' => 'required',
                'role' => 'required',
            ],
            [
                'username.required' => 'Username wajib di isi',
                'email.required' => 'Email wajib di isi',
                'password.required' => 'Password wajib di isi',
                'nama_lengkap.required' => 'Nama Lengkap wajib di isi',
                'alamat.required' => 'Alamat wajib di isi',
                'role.required' => 'Role wajib di isi',
            ],
        );

        // PROSES MENYIMPAN REQUEST KE VARIABEL $DATA
        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'role' => $request->role,
        ];

        User::create($data); // PROSES CREATE DATA
        return redirect()->route('login')->with('success', 'Berhasil melakukan registrasi'); // PROSES REDIRECT KE HALAMAN SEMULA
    }
}
