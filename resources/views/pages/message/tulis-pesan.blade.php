@extends('layouts.main')
@section('title') {{ 'Tulis Pesan' }} @endsection

@section('master')
    <div class="container-fluid py-4">
      <div class="card">
        <div class="card-header">
          <h3 class="my-0">Tulis Pesan</h3>
        </div>
        <form>
          <div class="card-body">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Tujuan</label>
              <select class="form-control" id="exampleFormControlSelect1">
                <option>SIAM (MAHASISWA)</option>
                <option>SIMA (DOSEN)</option>
                <option>SIRAK (PROGRAM STUDI)</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Isi</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="d-flex justify-content-end">
              <a href="../pages/message.html" class="btn btn-secondary me-2">Batal</a>
              <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
          </div>
        </form>
      </div>
    </div>
@endsection