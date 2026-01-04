<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\RPS;
use App\Models\RpsPertemuan;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class RPSController extends Controller
{
    public function index(Request $request)
    {
        $query = RPS::with('mataKuliah');

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('mataKuliah', function ($q) use ($search) {
                $q->where('nama_mk', 'like', "%{$search}%")
                  ->orWhere('kode_mk', 'like', "%{$search}%");
            })->orWhere('dosen_pengampu', 'like', "%{$search}%");
        }

        $rps = $query->orderBy('created_at', 'desc')->get();
        return view('rps.index', compact('rps'));
    }

    public function create()
    {
        $mataKuliah = MataKuliah::orderBy('nama_mk')->get();
        return view('rps.create', compact('mataKuliah'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'tahun_ajaran' => 'required|max:10',
            'semester' => 'required|in:Ganjil,Genap',
            'dosen_pengampu' => 'required|max:255',
            'capaian_pembelajaran' => 'required',
            'prasyarat' => 'nullable|max:255',
            'referensi' => 'required',
            'metode_pembelajaran' => 'required',
            'metode_penilaian' => 'required',
            'status' => 'required|in:Draft,Final'
        ]);

        $rps = RPS::create($validated);

        // Save pertemuan data
        for ($i = 1; $i <= 16; $i++) {
            if ($request->has("materi_{$i}")) {
                RpsPertemuan::create([
                    'rps_id' => $rps->id,
                    'pertemuan_ke' => $i,
                    'materi' => $request->input("materi_{$i}"),
                    'metode' => $request->input("metode_{$i}"),
                    'waktu' => $request->input("waktu_{$i}", 150)
                ]);
            }
        }

        return redirect()->route('rps.show', $rps->id)
            ->with('success', 'RPS berhasil dibuat');
    }

    public function show($id)
    {
        $rps = RPS::with(['mataKuliah', 'pertemuan'])->findOrFail($id);
        return view('rps.show', compact('rps'));
    }

    public function edit($id)
    {
        $rps = RPS::with('pertemuan')->findOrFail($id);
        $mataKuliah = MataKuliah::orderBy('nama_mk')->get();
        return view('rps.edit', compact('rps', 'mataKuliah'));
    }

    public function update(Request $request, $id)
    {
        $rps = RPS::findOrFail($id);

        $validated = $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'tahun_ajaran' => 'required|max:10',
            'semester' => 'required|in:Ganjil,Genap',
            'dosen_pengampu' => 'required|max:255',
            'capaian_pembelajaran' => 'required',
            'prasyarat' => 'nullable|max:255',
            'referensi' => 'required',
            'metode_pembelajaran' => 'required',
            'metode_penilaian' => 'required',
            'status' => 'required|in:Draft,Final'
        ]);

        $rps->update($validated);

        // Delete existing pertemuan and create new ones
        $rps->pertemuan()->delete();

        for ($i = 1; $i <= 16; $i++) {
            if ($request->has("materi_{$i}")) {
                RpsPertemuan::create([
                    'rps_id' => $rps->id,
                    'pertemuan_ke' => $i,
                    'materi' => $request->input("materi_{$i}"),
                    'metode' => $request->input("metode_{$i}"),
                    'waktu' => $request->input("waktu_{$i}", 150)
                ]);
            }
        }

        return redirect()->route('rps.show', $rps->id)
            ->with('success', 'RPS berhasil diperbarui');
    }

    public function destroy($id)
    {
        $rps = RPS::findOrFail($id);

        // Delete QR code file if exists
        if ($rps->qr_code_path && Storage::disk('public')->exists($rps->qr_code_path)) {
            Storage::disk('public')->delete($rps->qr_code_path);
        }

        $rps->delete();

        return redirect()->route('rps.index')
            ->with('success', 'RPS berhasil dihapus');
    }

    public function generateQRCode($id)
    {
        $rps = RPS::findOrFail($id);

        $timestamp = time();
        $hash = hash('sha256', $rps->id . config('app.key') . $timestamp);

        $qrData = json_encode([
            'rps_id' => $rps->id,
            'timestamp' => $timestamp,
            'hash' => $hash
        ]);

        // Create directory if not exists
        $directory = 'qrcodes';
        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        // Generate QR code
        $filename = 'qrcodes/rps_' . $rps->id . '_' . $timestamp . '.png';
        $qrCode = QrCode::format('png')->size(300)->generate($qrData);
        Storage::disk('public')->put($filename, $qrCode);

        // Update RPS with QR code info
        $rps->update([
            'qr_code_path' => $filename,
            'qr_code_hash' => $hash
        ]);

        return redirect()->route('rps.show', $rps->id)
            ->with('success', 'QR Code berhasil dibuat');
    }

    public function verifyQRCode(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('rps.verify');
        }

        $request->validate([
            'qr_data' => 'required'
        ]);

        try {
            $data = json_decode($request->qr_data, true);

            if (!isset($data['rps_id']) || !isset($data['timestamp']) || !isset($data['hash'])) {
                return back()->with('error', 'Format QR Code tidak valid');
            }

            $rps = RPS::find($data['rps_id']);

            if (!$rps) {
                return back()->with('error', 'RPS tidak ditemukan');
            }

            $expectedHash = hash('sha256', $data['rps_id'] . config('app.key') . $data['timestamp']);

            if ($expectedHash === $data['hash'] && $rps->qr_code_hash === $data['hash']) {
                return back()->with([
                    'success' => 'QR Code valid!',
                    'rps' => $rps
                ]);
            } else {
                return back()->with('error', 'QR Code tidak valid atau telah dimodifikasi');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memverifikasi QR Code: ' . $e->getMessage());
        }
    }

    public function exportPDF($id)
    {
        $rps = RPS::with(['mataKuliah', 'pertemuan'])->findOrFail($id);

        $pdf = Pdf::loadView('rps.pdf', compact('rps'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('RPS_' . $rps->mataKuliah->kode_mk . '_' . $rps->tahun_ajaran . '.pdf');
    }
}
