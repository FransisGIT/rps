@extends('layouts.app')

@section('title', 'Edit Mata Kuliah')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0"><i class="bi bi-pencil"></i> Edit Mata Kuliah</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('mata-kuliah.update', $mataKuliah->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="kode_mk" class="form-label">Kode Mata Kuliah <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('kode_mk') is-invalid @enderror" 
                               id="kode_mk" name="kode_mk" value="{{ old('kode_mk', $mataKuliah->kode_mk) }}" required>
                        @error('kode_mk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_mk" class="form-label">Nama Mata Kuliah <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_mk') is-invalid @enderror" 
                               id="nama_mk" name="nama_mk" value="{{ old('nama_mk', $mataKuliah->nama_mk) }}" required>
                        @error('nama_mk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="sks" class="form-label">SKS <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('sks') is-invalid @enderror" 
                                   id="sks" name="sks" value="{{ old('sks', $mataKuliah->sks) }}" 
                                   min="1" required>
                            @error('sks')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('semester') is-invalid @enderror" 
                                   id="semester" name="semester" value="{{ old('semester', $mataKuliah->semester) }}" 
                                   min="1" required>
                            @error('semester')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="prodi" class="form-label">Program Studi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('prodi') is-invalid @enderror" 
                               id="prodi" name="prodi" value="{{ old('prodi', $mataKuliah->prodi) }}" required>
                        @error('prodi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                  id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $mataKuliah->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('mata-kuliah.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-save"></i> Update Mata Kuliah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
