<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 4px; text-align: center; }
        .header-table th { border: none; }
        .title { font-size: 14px; font-weight: bold; }
        .no-border { border: none !important; }
    </style>
</head>
<body>
    {{-- Header --}}
    <table class="header-table">
        <tr>
            <th style="width: 15%">PT. KAHATEX</th>
            <th class="no-border"></th>
            <th style="width: 35%; text-align:center;" class="title" colspan="3">FORMULIR<br>DEPARTEMEN KAOS KAKI<br>KRONOLOGI KESALAHAN DATA ERP</th>
            <th class="no-border"></th>
            <th style="width: 15%">Tanggal Revisi</th>
            <th style="width: 15%">07 April 2025</th>
        </tr>
        <tr>
            <td>No. Dokumen</td>
            <td colspan="2">FOR-KK-550/REV_01/HAL_1/1</td>
            <td class="no-border"></td>
            <td>Klasifikasi</td>
            <td>Internal</td>
            <td class="no-border"></td>
        </tr>
        <tr><td colspan="8" class="no-border">&nbsp;</td></tr>
    </table>

    {{-- Kolom Nama User --}}
    <table class="header-table">
        <tr>
            <th class="no-border" style="width:15%">NAMA USER</th>
            <td class="no-border" style="width:85%">: ___________________</td>
        </tr>
    </table>
    <br>

    {{-- Tabel Data --}}
    <table>
        <thead>
            <tr>
                <th rowspan="2">TANGGAL</th>
                <th rowspan="2">WIP</th>
                <th rowspan="2">AREA</th>
                <th colspan="5">DATA BARANG SALAH</th>
                <th colspan="5">DATA BARANG BENAR</th>
                <th rowspan="2">KATEGORI</th>
                <th rowspan="2">KETERANGAN</th>
                <th rowspan="2">KETERANGAN MAINTENANCE</th>
                <th rowspan="2">USERNAME</th>
            </tr>
            <tr>
                <th>NO. MODEL</th><th>STYLE</th><th>LABEL</th>
                <th>NO MC</th><th>KRJ / QTY</th>
                <th>NO. MODEL</th><th>STYLE</th><th>LABEL</th>
                <th>NO MC</th><th>KRJ / QTY</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $i)
            <tr>
                <td>{{ \Carbon\Carbon::parse($i->tanggal)->format('d M Y') }}</td>
                <td>{{ $i->wip }}</td>
                <td>{{ $i->area }}</td>
                <td>{{ $i->no_model_salah }}</td>
                <td>{{ $i->style_salah }}</td>
                <td>{{ $i->label_salah }}</td>
                <td>{{ $i->no_mc_salah }}</td>
                <td>{{ $i->krj_salah }} / {{ $i->qty_salah }}</td>
                <td>{{ $i->no_model_benar }}</td>
                <td>{{ $i->style_benar }}</td>
                <td>{{ $i->label_benar }}</td>
                <td>{{ $i->no_mc_benar }}</td>
                <td>{{ $i->krj_benar }} / {{ $i->qty_benar }}</td>
                <td>{{ $i->kategori }}</td>
                <td>{{ $i->keterangan }}</td>
                <td>{{ $i->keterangan_maintenance }}</td>
                <td>{{ $i->username }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
