@extends('layouts.app')

@section('title', 'Tambah Mata Kuliah')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Tambah Mata Kuliah Baru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('mata-kuliah.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="kode_mk" class="form-label">Kode Mata Kuliah <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('kode_mk') is-invalid @enderror" 
                               id="kode_mk" name="kode_mk" value="{{ old('kode_mk') }}" 
                               placeholder="Contoh: TI101" required>
                        @error('kode_mk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_mk" class="form-label">Nama Mata Kuliah <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_mk') is-invalid @enderror" 
                               id="nama_mk" name="nama_mk" value="{{ old('nama_mk') }}" 
                               placeholder="Contoh: Pemrograman Web" required>
                        @error('nama_mk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="sks" class="form-label">SKS <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('sks') is-invalid @enderror" 
                                   id="sks" name="sks" value="{{ old('sks') }}" 
                                   min="1" placeholder="Contoh: 3" required>
                            @error('sks')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('semester') is-invalid @enderror" 
                                   id="semester" name="semester" value="{{ old('semester') }}" 
                                   min="1" placeholder="Contoh: 5" required>
                            @error('semester')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="prodi" class="form-label">Program Studi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('prodi') is-invalid @enderror" 
                               id="prodi" name="prodi" value="{{ old('prodi') }}" 
                               placeholder="Contoh: Teknik Informatika" required>
                        @error('prodi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                  id="deskripsi" name="deskripsi" rows="3" 
                                  placeholder="Deskripsi mata kuliah (opsional)">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('mata-kuliah.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Mata Kuliah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
