@extends('layouts.main')

@section('title', 'Presensi Kuliah')

@section('master')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="numbers">
            <p class="text-md mb-0 text-uppercase font-weight-bold">Presensi Kuliah</p>
            <hr class="horizontal dark" />
          </div>
          @if($data['daftarMkPresensi'] && ($data['kontrol']->STATUS == 3 || $data['kontrol']->STATUS == 4))
          <form class="form" method="post" action="{{ route('DetailPresensi') }}">
            @csrf
            <input type="hidden" name="tahun_semester" value="{{ $data['kontrol']->SEMESTER }}" />
            <div class="content controls">
              <div class="form-row">
                <div class="col-md-3">Pilih Matakuliah </div>
                <div class="col-md-12">
                  <select class="form-control py-2" name="mk" id="mk" placeholder="Departure">
                    @foreach ($data['daftarMkPresensi'] as $mk)
                    <option value="{{ $mk->ID_MK_TERSEDIA }}">{{ $mk->NAMA_MK }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="content controls">
              <div class="footer tar pull-right">
                <div class="btn-group py-2">
                  <button class="btn bg-gradient-success" name="Submit" type="submit" value="Cari">Cari</button>
                </div>
              </div>
            </div>
          </form>
          @elseif((auth()->user() == NULL) && ($data['daftarMkPresensi'] == NULL))
          <div class="text text-white alert alert-warning">
            <h3>Error!</h3>
            <div class="content">
              <h5>Message</h5>
              <p>Maaf, data tidak dapat ditampilkan. Ada gangguan teknis.</p>
              <p><b>Event type:</b> unknown error - data uncomplete<br>
                <b>Page:</b> Lihat Presensi Kuliah
              </p>
            </div>
          </div>
          @elseif($data['kontrol']->STATUS != 3 && $data['kontrol']->STATUS != 4)
          <div class="text text-white alert alert-primary">
            <h3 class="text text-white">Presensi tidak dapat ditampilkan</h3>
            <div class="content">
              <h5 class="text text-white">Message</h5>
              <p>Saat ini belum memasuki perkuliahan.</p>
              <p><b>Event type:</b> unauthorize view<br>
                <b>Page:</b> Lihat Presensi Kuliah
              </p>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection