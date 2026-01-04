@extends('layouts.app')

@section('title', 'Daftar RPS')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-file-earmark-text"></i> Daftar RPS</h2>
    <a href="{{ route('rps.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah RPS
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('rps.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" 
                       placeholder="Cari berdasarkan mata kuliah atau dosen..." 
                       value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('rps.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x"></i> Reset
                    </a>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Mata Kuliah</th>
                        <th>Dosen Pengampu</th>
                        <th>Tahun Ajaran</th>
                        <th>Semester</th>
                        <th>Status</th>
                        <th style="width: 300px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rps as $item)
                    <tr>
                        <td>
                            <strong>{{ $item->mataKuliah->kode_mk }}</strong><br>
                            {{ $item->mataKuliah->nama_mk }}
                        </td>
                        <td>{{ $item->dosen_pengampu }}</td>
                        <td>{{ $item->tahun_ajaran }}</td>
                        <td>{{ $item->semester }}</td>
                        <td>
                            @if($item->status == 'Final')
                                <span class="badge bg-success">Final</span>
                            @else
                                <span class="badge bg-warning text-dark">Draft</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('rps.show', $item->id) }}" class="btn btn-sm btn-info text-white">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('rps.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            @if(!$item->qr_code_path)
                                <a href="{{ route('rps.generate-qr', $item->id) }}" class="btn btn-sm btn-success">
                                    <i class="bi bi-qr-code"></i>
                                </a>
                            @endif
                            <a href="{{ route('rps.pdf', $item->id) }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-file-pdf"></i>
                            </a>
                            <form action="{{ route('rps.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="confirmDelete(event)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                            <p class="mt-2">
                                @if(request('search'))
                                    Tidak ada RPS yang sesuai dengan pencarian
                                @else
                                    Belum ada data RPS
                                @endif
                            </p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
