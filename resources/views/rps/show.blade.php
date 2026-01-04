@extends('layouts.app')

@section('title', 'Detail RPS')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-file-earmark-text"></i> Detail RPS</h2>
            <div>
                <a href="{{ route('rps.edit', $rps->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                @if(!$rps->qr_code_path)
                    <a href="{{ route('rps.generate-qr', $rps->id) }}" class="btn btn-success">
                        <i class="bi bi-qr-code"></i> Generate QR
                    </a>
                @endif
                <a href="{{ route('rps.pdf', $rps->id) }}" class="btn btn-primary">
                    <i class="bi bi-file-pdf"></i> Download PDF
                </a>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Informasi Mata Kuliah</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th style="width: 200px;">Kode MK</th>
                        <td>{{ $rps->mataKuliah->kode_mk }}</td>
                    </tr>
                    <tr>
                        <th>Nama Mata Kuliah</th>
                        <td>{{ $rps->mataKuliah->nama_mk }}</td>
                    </tr>
                    <tr>
                        <th>SKS</th>
                        <td>{{ $rps->mataKuliah->sks }}</td>
                    </tr>
                    <tr>
                        <th>Program Studi</th>
                        <td>{{ $rps->mataKuliah->prodi }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Detail RPS</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th style="width: 200px;">Tahun Ajaran</th>
                        <td>{{ $rps->tahun_ajaran }}</td>
                    </tr>
                    <tr>
                        <th>Semester</th>
                        <td>{{ $rps->semester }}</td>
                    </tr>
                    <tr>
                        <th>Dosen Pengampu</th>
                        <td>{{ $rps->dosen_pengampu }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($rps->status == 'Final')
                                <span class="badge bg-success">Final</span>
                            @else
                                <span class="badge bg-warning text-dark">Draft</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Prasyarat</th>
                        <td>{{ $rps->prasyarat ?: '-' }}</td>
                    </tr>
                    <tr>
                        <th>Capaian Pembelajaran</th>
                        <td>{{ $rps->capaian_pembelajaran }}</td>
                    </tr>
                    <tr>
                        <th>Referensi</th>
                        <td>{{ $rps->referensi }}</td>
                    </tr>
                    <tr>
                        <th>Metode Pembelajaran</th>
                        <td>{{ $rps->metode_pembelajaran }}</td>
                    </tr>
                    <tr>
                        <th>Metode Penilaian</th>
                        <td>{{ $rps->metode_penilaian }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Rencana Pertemuan</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 100px;">Pertemuan</th>
                                <th>Materi</th>
                                <th style="width: 200px;">Metode</th>
                                <th style="width: 100px;">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rps->pertemuan as $p)
                            <tr>
                                <td class="text-center">{{ $p->pertemuan_ke }}</td>
                                <td>{{ $p->materi }}</td>
                                <td>{{ $p->metode }}</td>
                                <td class="text-center">{{ $p->waktu }} menit</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada data pertemuan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <a href="{{ route('rps.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar RPS
            </a>
        </div>
    </div>

    <div class="col-lg-4">
        @if($rps->qr_code_path)
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="bi bi-qr-code"></i> QR Code</h5>
            </div>
            <div class="card-body text-center">
                <img src="{{ asset('storage/' . $rps->qr_code_path) }}" 
                     alt="QR Code" class="img-fluid mb-3" style="max-width: 300px;">
                <p class="text-muted small">Scan QR Code untuk verifikasi</p>
                <a href="{{ route('rps.verify') }}" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-shield-check"></i> Verifikasi QR Code
                </a>
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-body text-center py-4">
                <i class="bi bi-qr-code" style="font-size: 4rem; color: #ccc;"></i>
                <p class="mt-3">QR Code belum dibuat</p>
                <a href="{{ route('rps.generate-qr', $rps->id) }}" class="btn btn-success">
                    <i class="bi bi-qr-code"></i> Generate QR Code
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
