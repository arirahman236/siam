@extends('layouts.main')
@section('title', 'KRS')

@section('master')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="numbers">
                        <p class="text-md mb-0 text-uppercase font-weight-bold">Kartu Rencana Studi</p>
                    </div>
                    <hr class="horizontal dark" />
                    <form method="post" action="{{ url('detail-KRS') }}" class="form" id="simple_form">
                        @csrf
                        <div class="content controls">
                            <div class="row">
                                <div class="col">Semester</div>
                                <div class="col">
                                    <select class="form-select" name="semester" id="semester">
                                        @if ($data['kontrol']->KODE_SEMESTER == '1')
                                        @php $smtnya = "Ganjil"; @endphp
                                        @elseif ($data['kontrol']->KODE_SEMESTER == '2')
                                        @php $smtnya = "Genap"; @endphp
                                        @else
                                        @php $smtnya = "Genap-P"; @endphp
                                        @endif
                                        <option value="{{ $data['kontrol']->KODE_SEMESTER }}">{{ $smtnya }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">Tahun</div>
                                <div class="col">
                                    <select class="form-select" name="tahun" id="tahun">
                                        @php
                                        $currentTahunAjaran = $data['kontrol']->TAHUN_AKADEMIK;
                                        $nextTahunAjaran = $currentTahunAjaran + 1;
                                        @endphp
                                        <option value="{{ $currentTahunAjaran }}"> {{ $currentTahunAjaran }} /
                                            {{ $nextTahunAjaran }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="content controls my-2">
                            <div class="btn-group">
                                <button class="btn btn-primary" name="Submit" type="submit" value="Proses">Proses
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection