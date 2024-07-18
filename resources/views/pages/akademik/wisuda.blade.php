@extends('layouts.main')
@section('title') {{ 'Wisuda' }} @endsection

@section('master')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="numbers">
            <p class="text-md mb-0 text-uppercase font-weight-bold">UPLOAD DATA WISUDA</p>
            <hr class="horizontal dark" />
          </div>
          @if($data['cek'] ?? null)
          <form method="POST" action="{{ route('wisuda-upload') }}" class="block-content form" id="simple_form" enctype="multipart/form-data">
            @csrf
            <div class="content controls">
              <div class="col-md-12">
                <div class="row">
                  <div class="form-group col-md-4">
                    <div class="card">
                      <div class="card-body">
                        <h5>Foto</h5>
                        <input type="file" name="foto" class="form-control">
                        <p class="bottom">Format file .jpg/.png *maksimal 1 MB</p>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-md-4">
                    <div class="card">
                      <div class="card-body">
                        <h5>Soft Copy</h5>
                        <input type="file" name="doc" class="form-control">
                        <span class="bottom">Format file .pdf</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-md-4">
                    <div class="card">
                      <div class="card-body">
                        <h5>Ijazah</h5>
                        <input type="file" name="ijazah" class="form-control">
                        <span class="bottom">Format file .jpg *maksimal 1 MB</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="content controls">
                <div class="footer text-right">
                  <div class="btn-group">
                    <button type="submit" class="btn bg-gradient-success">Submit</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
          @else
          <div class="alert alert-primary text-white">
            <h3 class="text-white">Perhatian</h3>
            <div class="content">
              <h5 class="text-white">Message</h5>
              <p>Maaf, Anda tidak dapat mengakses menu ini karena nilai skripsi belum tersedia.</p>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection