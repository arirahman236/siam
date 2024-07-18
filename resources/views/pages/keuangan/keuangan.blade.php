@extends('layouts.main')
@section('title')
{{ 'Keuangan' }}
@endsection

@section('master')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="numbers">
                        <p class="text-md mb-0 text-uppercase font-weight-bold">Detail Tagihan</p>
                        <hr class="horizontal dark" />
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama
                                        Transaksi</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Debet</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kredit</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $item)
                                @if (isset($item))
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-xs ms-3">
                                                    {{ $item['no'] }}
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-xs">
                                                    {!! $item['nama_transaksi'] !!}
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-xs">
                                                    {{ $item['debet'] }}
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-xs">
                                                    {{ $item['kredit'] }}
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-xs">
                                                    {{ $item['saldo'] }}
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @else
                                <h6 class="mb-0 text-xs ms-3">
                                    Data Tidak Tersedia
                                </h6>
                                @endif
                                @endforeach
                                @if (isset($item))
                                <tr>
                                    <td colspan="2" class="text-center">Jumlah</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-xs">
                                                    {{ $item['jumlah_nominal'] }}
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-xs">
                                                    {{ $item['jumlah_kredit'] }}
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <td colspan="2" class="text-center"></td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="my-auto">
                                                <h6 class="mb-0 text-xs">
                                                    Data Tidak tersedia
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection