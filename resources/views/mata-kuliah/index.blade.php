@extends('layouts.app')

@section('title', 'Daftar Mata Kuliah')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-journals"></i> Daftar Mata Kuliah</h2>
    <a href="{{ route('mata-kuliah.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Mata Kuliah
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Kode MK</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Prodi</th>
                        <th style="width: 250px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mataKuliah as $mk)
                    <tr>
                        <td><strong>{{ $mk->kode_mk }}</strong></td>
                        <td>{{ $mk->nama_mk }}</td>
                        <td>{{ $mk->sks }}</td>
                        <td>{{ $mk->semester }}</td>
                        <td>{{ $mk->prodi }}</td>
                        <td>
                            <a href="{{ route('mata-kuliah.edit', $mk->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <a href="{{ route('rps.create', ['mata_kuliah_id' => $mk->id]) }}" class="btn btn-sm btn-success">
                                <i class="bi bi-file-plus"></i> Buat RPS
                            </a>
                            <form action="{{ route('mata-kuliah.destroy', $mk->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="confirmDelete(event)">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                            <p class="mt-2">Belum ada data mata kuliah</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
