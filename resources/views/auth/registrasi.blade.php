@extends('_template_auth.main')
<title>Registrasi</title>
@section('content')

  <!-- page -->
  <div class="page">

    <!-- main-signin-wrapper -->
    <div class="my-auto page page-h">
        <div class="main-signin-wrapper">
            <div class="main-card-signin wd-md-500p">
                <div class="sign-up-body wd-md-500p">
                    <div class="main-signin-header">
                        <h2>Selamat Datang</h2>
                        <div class="px-0 col-12 mb-2">
                           
                        </div>
                        <h6>Form Registrasi</h6>
                        <form method="POST" action="{{ route('auth_regis') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Username</label>
                                <input name="username" class="form-control" placeholder="Enter your username"
                                    type="text" value="{{ old('username') }}"equired autofocus>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" class="form-control" placeholder="Enter your email" type="email"
                                    value="{{ old('email') }}"equired autofocus>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input name="password" class="form-control" placeholder="Enter your password"
                                    type="password" value="{{ old('password') }}" required>
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input name="nama_lengkap" class="form-control" placeholder="Enter your nama lengkap"
                                    type="text" value="{{ old('nama_lengkap') }}"equired autofocus>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input name="alamat" class="form-control" placeholder="Enter your alamat"
                                    type="text" value="{{ old('alamat') }}"equired autofocus>
                            </div>
                            <div class="form-group">
                                <label>Hak Akses</label>
                                <select name="role" class="form-control select2" id="">
                                    <option value="">=== Pilih Hak Akses ===</option>
                                    <option value="administrator">Administrator</option>
                                </select>
                            </div>
                            <a href="{{ route('login') }}" style="margin-left: 4em" class="btn btn-info"><< Back</a>
                                    <button type="submit" class="btn btn-primary"><i class="fe fe-log-in"></i>Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End page -->
    
@endsection