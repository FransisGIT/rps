<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>RPS - {{ $rps->mataKuliah->kode_mk }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #333;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid #000;
        }
        .header h1 {
            font-size: 18px;
            margin-bottom: 5px;
        }
        .header h2 {
            font-size: 14px;
            margin-bottom: 3px;
            font-weight: normal;
        }
        .section {
            margin-bottom: 15px;
        }
        .section-title {
            background-color: #333;
            color: white;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        table.info-table td {
            padding: 4px 8px;
            border: none;
        }
        table.info-table td:first-child {
            width: 180px;
            font-weight: bold;
        }
        table.pertemuan-table {
            border: 1px solid #333;
        }
        table.pertemuan-table th {
            background-color: #f0f0f0;
            padding: 6px;
            border: 1px solid #333;
            font-size: 10px;
            text-align: left;
        }
        table.pertemuan-table td {
            padding: 5px;
            border: 1px solid #333;
            font-size: 10px;
        }
        .text-content {
            padding: 5px 10px;
            text-align: justify;
        }
        .footer {
            position: fixed;
            bottom: 15px;
            left: 20px;
            right: 20px;
            text-align: center;
            font-size: 9px;
            color: #666;
            border-top: 1px solid #ccc;
            padding-top: 8px;
        }
        .qr-code {
            text-align: center;
            margin-top: 10px;
        }
        .qr-code img {
            width: 100px;
            height: 100px;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-success {
            background-color: #28a745;
            color: white;
        }
        .badge-warning {
            background-color: #ffc107;
            color: #333;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>RENCANA PEMBELAJARAN SEMESTER (RPS)</h1>
        <h2>{{ $rps->mataKuliah->prodi }}</h2>
        <h2>Tahun Ajaran {{ $rps->tahun_ajaran }} - Semester {{ $rps->semester }}</h2>
    </div>

    <div class="section">
        <div class="section-title">IDENTITAS MATA KULIAH</div>
        <table class="info-table">
            <tr>
                <td>Kode Mata Kuliah</td>
                <td>: {{ $rps->mataKuliah->kode_mk }}</td>
            </tr>
            <tr>
                <td>Nama Mata Kuliah</td>
                <td>: {{ $rps->mataKuliah->nama_mk }}</td>
            </tr>
            <tr>
                <td>Bobot (SKS)</td>
                <td>: {{ $rps->mataKuliah->sks }} SKS</td>
            </tr>
            <tr>
                <td>Semester</td>
                <td>: {{ $rps->mataKuliah->semester }}</td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>: {{ $rps->mataKuliah->prodi }}</td>
            </tr>
            <tr>
                <td>Dosen Pengampu</td>
                <td>: {{ $rps->dosen_pengampu }}</td>
            </tr>
            <tr>
                <td>Prasyarat</td>
                <td>: {{ $rps->prasyarat ?: '-' }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>: 
                    @if($rps->status == 'Final')
                        <span class="badge badge-success">FINAL</span>
                    @else
                        <span class="badge badge-warning">DRAFT</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">CAPAIAN PEMBELAJARAN</div>
        <div class="text-content">
            {{ $rps->capaian_pembelajaran }}
        </div>
    </div>

    <div class="section">
        <div class="section-title">METODE PEMBELAJARAN</div>
        <div class="text-content">
            {{ $rps->metode_pembelajaran }}
        </div>
    </div>

    <div class="section">
        <div class="section-title">METODE PENILAIAN</div>
        <div class="text-content">
            {{ $rps->metode_penilaian }}
        </div>
    </div>

    <div class="section">
        <div class="section-title">REFERENSI</div>
        <div class="text-content">
            {{ $rps->referensi }}
        </div>
    </div>

    <div class="page-break"></div>

    <div class="section">
        <div class="section-title">RENCANA PERTEMUAN</div>
        <table class="pertemuan-table">
            <thead>
                <tr>
                    <th style="width: 60px;">Minggu</th>
                    <th>Materi Pembelajaran</th>
                    <th style="width: 120px;">Metode</th>
                    <th style="width: 60px;">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rps->pertemuan as $p)
                <tr>
                    <td style="text-align: center;">{{ $p->pertemuan_ke }}</td>
                    <td>{{ $p->materi }}</td>
                    <td>{{ $p->metode }}</td>
                    <td style="text-align: center;">{{ $p->waktu }}'</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($rps->qr_code_path)
    <div class="qr-code">
        <div style="font-size: 10px; margin-bottom: 5px;">
            <strong>Verifikasi Digital</strong>
        </div>
        <img src="{{ public_path('storage/' . $rps->qr_code_path) }}" alt="QR Code">
        <div style="font-size: 9px; color: #666; margin-top: 5px;">
            Scan untuk verifikasi keaslian dokumen
        </div>
    </div>
    @endif

    <div class="footer">
        Dokumen ini digenerate secara otomatis oleh Sistem SIAKAD RPS pada {{ date('d/m/Y H:i:s') }}
        @if($rps->qr_code_path)
            <br>Dilindungi dengan Digital Signature - Hash: {{ substr($rps->qr_code_hash, 0, 16) }}...
        @endif
    </div>
</body>
</html>
