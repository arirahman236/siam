@extends('layouts.main')

@section('title')
    {{ 'Kartu Hasil Studi' }}
@endsection

@section('master')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="numbers">
                            <p class="text-md mb-0 text-uppercase font-weight-bold">Kartu Hasil Studi</p>
                        </div>
                        <hr class="horizontal dark" />
                        <form method="post" action="{{ route('detail-khs') }}" class="form" id="simple_form">
                            @csrf
                            <div class="content controls">
                                <div class="row">
                                    <div class="col">Semester</div>
                                    <div class="col">
                                        <select class="form-select" name="semester" id="semester">
                                            <option value="1">Ganjil</option>
                                            <option value="2">Genap</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">Tahun</div>
                                    <div class="col">
                                        <select class="form-select" name="tahun" id="tahun">
                                            @if (isset($data['mhs']))
                                                @php
                                                    $tahunSekarang = date('Y');
                                                    $tahunMasuk = $data['mhs']->TAHUN_MASUK;
                                                @endphp
                                                @for ($tahun = $tahunMasuk; $tahun <= $tahunSekarang; $tahun++)
                                                    <option value="{{ $tahun }}">
                                                        {{ $tahun }}/{{ $tahun + 1 }}
                                                    </option>
                                                @endfor
                                            @else
                                                <p>Data Mahasiswa tidak ditemukan.</p>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="content controls my-2">
                                <div class="btn-group">
                                    <button class="btn btn-primary" name="Submit" type="submit"
                                        value="Proses">Proses</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(function() {
                // Inisialisasi form KHS
                $('#simple_form').initForm({
                    rules: {
                        semester: {
                            required: true
                        },
                        tahun: {
                            required: true
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
