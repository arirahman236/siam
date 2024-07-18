@extends('layouts.main')
@section('title') {{ 'Message' }} @endsection

@section('master')
    <div class="container-fluid py-4">
      <div class="card">
        <div class="card-header">
          <h3 class="my-0">Kotak Masuk Pesan</h3>
        </div>
        <div class="card-body mt-0">
          <div class="text-end my-0">
            <a href="/tulis-pesan" class="btn btn-primary">Tulis Pesan</a>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pengirim</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Subjek</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                </tr>
              </thead>
              <tbody>
                <!-- Tidak ada pesan dalam kotak masuk -->
                <tr>
                  <td colspan="4" class="text-center">Tidak ada pesan dalam kotak masuk</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer py-4">
          <nav aria-label="...">
            <ul class="pagination justify-content-end mb-0">
              <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">
                  <i class="fas fa-angle-left"></i>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
              <li class="page-item active">
                <a class="page-link" href="#">1</a>
              </li>
              <li class="page-item disabled">
                <a class="page-link" href="#">Next
                  <span class="sr-only">Next</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
@endsection