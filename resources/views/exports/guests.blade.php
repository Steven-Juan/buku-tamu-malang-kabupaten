<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Data Tamu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: middle;
            word-wrap: break-word;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        /* Thumbnail styling */
        .img-container {
            text-align: center;
        }

        .photo-thumb {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
        }

        .sig-thumb {
            width: 70px;
            height: auto;
        }

        /* Column widths */
        .col-foto {
            width: 55px;
        }

        .col-nama {
            width: 100px;
        }

        .col-tujuan {
            width: 100px;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">LAPORAN DAFTAR TAMU</h2>
    <table>
        <thead>
            <tr>
                <th class="col-foto">Foto</th>
                <th class="col-nama">Nama Lengkap</th>
                <th>Asal Instansi</th>
                <th>Keperluan</th>
                <th>Pesan / Kesan</th>
                <th class="col-tujuan">Instansi Tujuan</th>
                <th>Tanggal & Waktu</th>
                <th>Tanda Tangan Digital</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($guests as $guest)
                <tr>
                    <td class="img-container">
                        @if ($guest->foto)
                            {{-- Gunakan public_path untuk memastikan DomPDF bisa mengakses file lokal --}}
                            <img src="{{ public_path('storage/' . $guest->foto) }}" class="photo-thumb">
                        @else
                            <span style="color: #ccc;">No Photo</span>
                        @endif
                    </td>
                    <td>{{ $guest->nama }}</td>
                    <td>{{ $guest->asal_instansi }}</td>
                    <td>{{ $guest->keperluan }}</td>
                    <td>{{ $guest->pesan_kesan ?? '-' }}</td>
                    <td>{{ $guest->perangkatDaerah->nama_pd ?? '-' }}</td>
                    <td style="text-align: center;">{{ $guest->created_at->format('d/m/Y H:i') }}</td>
                    <td class="img-container">
                        @if ($guest->ttd_digital)
                            <img src="{{ $guest->ttd_digital }}" class="sig-thumb">
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
