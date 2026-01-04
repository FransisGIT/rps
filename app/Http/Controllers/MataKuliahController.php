<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $mataKuliah = MataKuliah::orderBy('created_at', 'desc')->get();
        return view('mata-kuliah.index', compact('mataKuliah'));
    }

    public function create()
    {
        return view('mata-kuliah.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_mk' => 'required|unique:mata_kuliah,kode_mk|max:20',
            'nama_mk' => 'required|max:255',
            'sks' => 'required|integer|min:1',
            'semester' => 'required|integer|min:1',
            'prodi' => 'required|max:100',
            'deskripsi' => 'nullable'
        ]);

        MataKuliah::create($validated);

        return redirect()->route('mata-kuliah.index')
            ->with('success', 'Mata kuliah berhasil ditambahkan');
    }

    public function edit($id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);
        return view('mata-kuliah.edit', compact('mataKuliah'));
    }

    public function update(Request $request, $id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);

        $validated = $request->validate([
            'kode_mk' => 'required|max:20|unique:mata_kuliah,kode_mk,' . $id,
            'nama_mk' => 'required|max:255',
            'sks' => 'required|integer|min:1',
            'semester' => 'required|integer|min:1',
            'prodi' => 'required|max:100',
            'deskripsi' => 'nullable'
        ]);

        $mataKuliah->update($validated);

        return redirect()->route('mata-kuliah.index')
            ->with('success', 'Mata kuliah berhasil diperbarui');
    }

    public function destroy($id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);
        $mataKuliah->delete();

        return redirect()->route('mata-kuliah.index')
            ->with('success', 'Mata kuliah berhasil dihapus');
    }
}
