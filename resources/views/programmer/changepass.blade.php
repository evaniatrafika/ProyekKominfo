@extends('programmer/sidebar')
@section('konten')

@if (session('alert'))
    <div class="alert alert-danger">
        {{ session('alert') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="col-12 col-xl-8 mb-4 mb-xl-10">
  <h3 class="font-weight-bold">Ubah Password</h3>
      </div>
<form action="/confirmpass" method="POST">
  @csrf
  <div class="mb-3">
    <label for="InputOldPass" class="form-label">Password Lama</label>
    <input type="password" class="form-control w-50" id="InputOldPass" name="oldpass" min="1" maxlength="50">
  </div>
  <div class="mb-3">
    <label for="InputNewPass1" class="form-label">Password Baru</label>
    <input type="password" class="form-control w-50" id="InputNewPass1" name="newpass1"  min="8" maxlength="25">
  </div>
  <div class="mb-3">
    <label for="InputNewPass2" class="form-label">Konfirmasi Password</label>
    <input type="password" class="form-control w-50" id="InputNewPass2" aria-describedby="NewPass2" name="newpass2" min="8" maxlength="25">
    <div id="NewPass2" hidden class="form-text">Harap Masukkan Password Yang Sama</div>
    <div id="NewPass3" hidden class="form-text">Password Baru Harus Lebih Dari 5 Karakter</div>
  </div>
  <input type="submit" value="Simpan Perubahan" class="btn btn-primary" id="buttonconfirm" disabled>
</form>

<div class="mb-5"></div>

<script src="js/passconfirm.js"></script>

@endsection
