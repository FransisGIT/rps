@extends('layouts.app')

@section('title', 'Verifikasi QR Code')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-qr-code-scan"></i> Verifikasi QR Code RPS</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">
                    Paste data JSON dari QR Code yang telah Anda scan untuk memverifikasi keaslian dokumen RPS.
                </p>

                <form action="{{ route('rps.verify') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="qr_data" class="form-label">Data QR Code <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('qr_data') is-invalid @enderror" 
                                  id="qr_data" name="qr_data" rows="6" 
                                  placeholder='{"rps_id":1,"timestamp":1234567890,"hash":"..."}'
                                  required>{{ old('qr_data') }}</textarea>
                        @error('qr_data')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Format data harus berupa JSON yang valid
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-shield-check"></i> Verifikasi
                    </button>
                </form>

                @if(session('rps'))
                <div class="alert alert-success mt-4">
                    <h5><i class="bi bi-check-circle-fill"></i> Dokumen Valid!</h5>
                    <hr>
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <th style="width: 180px;">Mata Kuliah</th>
                            <td>{{ session('rps')->mataKuliah->kode_mk }} - {{ session('rps')->mataKuliah->nama_mk }}</td>
                        </tr>
                        <tr>
                            <th>Dosen Pengampu</th>
                            <td>{{ session('rps')->dosen_pengampu }}</td>
                        </tr>
                        <tr>
                            <th>Tahun Ajaran</th>
                            <td>{{ session('rps')->tahun_ajaran }} - {{ session('rps')->semester }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if(session('rps')->status == 'Final')
                                    <span class="badge bg-success">Final</span>
                                @else
                                    <span class="badge bg-warning text-dark">Draft</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                    <a href="{{ route('rps.show', session('rps')->id) }}" class="btn btn-sm btn-outline-primary mt-3">
                        <i class="bi bi-eye"></i> Lihat Detail RPS
                    </a>
                </div>
                @endif
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-light">
                <h6 class="mb-0"><i class="bi bi-info-circle"></i> Cara Menggunakan</h6>
            </div>
            <div class="card-body">
                <ol>
                    <li>Scan QR Code pada dokumen RPS menggunakan aplikasi QR Code scanner</li>
                    <li>Copy data JSON hasil scan</li>
                    <li>Paste data tersebut pada form di atas</li>
                    <li>Klik tombol "Verifikasi" untuk memvalidasi keaslian dokumen</li>
                </ol>
                <div class="alert alert-info mb-0">
                    <i class="bi bi-shield-check"></i> 
                    <strong>Keamanan:</strong> Sistem akan memverifikasi hash kriptografi untuk memastikan 
                    dokumen RPS tidak dimodifikasi atau dipalsukan.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
