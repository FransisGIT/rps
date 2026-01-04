@extends('layouts.app')

@section('title', 'Tambah RPS')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4"><i class="bi bi-plus-circle"></i> Tambah RPS Baru</h2>
    </div>
</div>

<form action="{{ route('rps.store') }}" method="POST">
    @csrf
    
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Umum RPS</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="mata_kuliah_id" class="form-label">Mata Kuliah <span class="text-danger">*</span></label>
                    <select class="form-select @error('mata_kuliah_id') is-invalid @enderror" 
                            id="mata_kuliah_id" name="mata_kuliah_id" required>
                        <option value="">-- Pilih Mata Kuliah --</option>
                        @foreach($mataKuliah as $mk)
                            <option value="{{ $mk->id }}" {{ old('mata_kuliah_id') == $mk->id ? 'selected' : '' }}>
                                {{ $mk->kode_mk }} - {{ $mk->nama_mk }}
                            </option>
                        @endforeach
                    </select>
                    @error('mata_kuliah_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="tahun_ajaran" class="form-label">Tahun Ajaran <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" 
                           id="tahun_ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran') }}" 
                           placeholder="2025/2026" required>
                    @error('tahun_ajaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                    <select class="form-select @error('semester') is-invalid @enderror" 
                            id="semester" name="semester" required>
                        <option value="">-- Pilih --</option>
                        <option value="Ganjil" {{ old('semester') == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                        <option value="Genap" {{ old('semester') == 'Genap' ? 'selected' : '' }}>Genap</option>
                    </select>
                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="dosen_pengampu" class="form-label">Dosen Pengampu <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('dosen_pengampu') is-invalid @enderror" 
                       id="dosen_pengampu" name="dosen_pengampu" value="{{ old('dosen_pengampu') }}" required>
                @error('dosen_pengampu')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="capaian_pembelajaran" class="form-label">Capaian Pembelajaran <span class="text-danger">*</span></label>
                <textarea class="form-control @error('capaian_pembelajaran') is-invalid @enderror" 
                          id="capaian_pembelajaran" name="capaian_pembelajaran" rows="4" required>{{ old('capaian_pembelajaran') }}</textarea>
                @error('capaian_pembelajaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="prasyarat" class="form-label">Prasyarat</label>
                <input type="text" class="form-control @error('prasyarat') is-invalid @enderror" 
                       id="prasyarat" name="prasyarat" value="{{ old('prasyarat') }}" 
                       placeholder="Contoh: Algoritma dan Pemrograman">
                @error('prasyarat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="referensi" class="form-label">Referensi <span class="text-danger">*</span></label>
                <textarea class="form-control @error('referensi') is-invalid @enderror" 
                          id="referensi" name="referensi" rows="3" required>{{ old('referensi') }}</textarea>
                @error('referensi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="metode_pembelajaran" class="form-label">Metode Pembelajaran <span class="text-danger">*</span></label>
                <textarea class="form-control @error('metode_pembelajaran') is-invalid @enderror" 
                          id="metode_pembelajaran" name="metode_pembelajaran" rows="3" required>{{ old('metode_pembelajaran') }}</textarea>
                @error('metode_pembelajaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="metode_penilaian" class="form-label">Metode Penilaian <span class="text-danger">*</span></label>
                <textarea class="form-control @error('metode_penilaian') is-invalid @enderror" 
                          id="metode_penilaian" name="metode_penilaian" rows="3" required>{{ old('metode_penilaian') }}</textarea>
                @error('metode_penilaian')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <select class="form-select @error('status') is-invalid @enderror" 
                        id="status" name="status" required>
                    <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                    <option value="Final" {{ old('status') == 'Final' ? 'selected' : '' }}>Final</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Rencana Pertemuan (16 Pertemuan)</h5>
        </div>
        <div class="card-body">
            @for($i = 1; $i <= 16; $i++)
            <div class="card mb-3">
                <div class="card-header bg-light">
                    <strong>Pertemuan ke-{{ $i }}</strong>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="materi_{{ $i }}" class="form-label">Materi</label>
                        <textarea class="form-control" id="materi_{{ $i }}" name="materi_{{ $i }}" rows="2">{{ old("materi_$i") }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="metode_{{ $i }}" class="form-label">Metode</label>
                            <input type="text" class="form-control" id="metode_{{ $i }}" name="metode_{{ $i }}" 
                                   value="{{ old("metode_$i") }}" placeholder="Contoh: Ceramah, Diskusi, Praktikum">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="waktu_{{ $i }}" class="form-label">Waktu (menit)</label>
                            <input type="number" class="form-control" id="waktu_{{ $i }}" name="waktu_{{ $i }}" 
                                   value="{{ old("waktu_$i", 150) }}" min="1">
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>

    <div class="d-flex justify-content-between mb-4">
        <a href="{{ route('rps.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Simpan RPS
        </button>
    </div>
</form>
@endsection
