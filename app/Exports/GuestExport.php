<?php

namespace App\Exports;

use App\Models\Guest;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GuestExport implements FromQuery, WithDrawings, WithEvents, WithHeadings, WithMapping, WithStyles
{
    protected $query;

    public function __construct($query = null)
    {
        $this->query = $query ?: Guest::query();
    }

    public function query()
    {
        return $this->query->with('perangkatDaerah');
    }

    public function headings(): array
    {
        return [
            'Foto',
            'Nama Lengkap',
            'Asal Instansi',
            'Keperluan',
            'Pesan / Kesan',
            'Instansi Tujuan',
            'Tanggal & Waktu',
            'Tanda Tangan Digital',
        ];
    }

    public function map($guest): array
    {
        return [
            '', // Placeholder Foto
            $guest->nama,
            $guest->asal_instansi,
            $guest->keperluan,
            $guest->pesan_kesan,
            $guest->perangkatDaerah->nama_pd ?? '-',
            $guest->created_at->format('d-m-Y H:i'),
            '', // Placeholder Signature
        ];
    }

    public function drawings()
    {
        $drawings = [];
        $records = $this->query()->get();

        foreach ($records as $index => $record) {
            $row = $index + 2;

            // 1. Handling FOTO
            if ($record->foto && File::exists(public_path('storage/'.$record->foto))) {
                $drawingPhoto = new Drawing;
                $drawingPhoto->setName('Photo');
                $drawingPhoto->setPath(public_path('storage/'.$record->foto));
                $drawingPhoto->setHeight(70);
                $drawingPhoto->setCoordinates('A'.$row);
                $drawingPhoto->setOffsetX(10);
                $drawingPhoto->setOffsetY(10);
                $drawings[] = $drawingPhoto;
            }
            // 2. Handling TTD
            if ($record->ttd_digital && str_contains($record->ttd_digital, 'base64,')) {
                try {
                    // Convert Base64 to Image File
                    $data = explode('base64,', $record->ttd_digital);
                    $decodedImage = base64_decode($data[1]);

                    $fileName = 'sig_'.$record->id.'_'.time().'.png';
                    $filePath = public_path('storage/'.$fileName);

                    // Ensure directory exists
                    if (! File::isDirectory(public_path('storage'))) {
                        File::makeDirectory(public_path('storage'), 0777, true);
                    }

                    File::put($filePath, $decodedImage);

                    if (File::exists($filePath)) {
                        $drawing = new Drawing;
                        $drawing->setName('Signature');
                        $drawing->setPath($filePath);
                        $drawing->setWidth(180);
                        $drawing->setCoordinates('H'.$row);
                        $drawing->setOffsetX(15);
                        $drawing->setOffsetY(25);
                        $drawings[] = $drawing;
                    }
                } catch (\Exception $e) {
                    continue;
                }
            }
        }

        return $drawings;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4F81BD'],
                ],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $lastRow = $sheet->getHighestRow();
                $range = "A1:H{$lastRow}";

                // 1. Set Lebar Kolom Secara Manual (Fixing Width)
                $sheet->getDelegate()->getColumnDimension('A')->setWidth(15); // Foto
                $sheet->getDelegate()->getColumnDimension('B')->setWidth(25); // Nama
                $sheet->getDelegate()->getColumnDimension('C')->setWidth(25); // Asal
                $sheet->getDelegate()->getColumnDimension('D')->setWidth(30); // Keperluan
                $sheet->getDelegate()->getColumnDimension('E')->setWidth(30); // Pesan
                $sheet->getDelegate()->getColumnDimension('F')->setWidth(30); // Tujuan
                $sheet->getDelegate()->getColumnDimension('G')->setWidth(20); // Waktu
                $sheet->getDelegate()->getColumnDimension('H')->setWidth(40); // Tanda Tangan (Sangat Lebar)

                // 2. Global Styling
                $sheet->getStyle($range)->applyFromArray([
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                    ],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'horizontal' => Alignment::HORIZONTAL_LEFT, // Teks rata kiri biar rapi
                    ],
                ]);

                // 3. Khusus Kolom Gambar & Header diset Tengah
                $sheet->getStyle("A1:A{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("H1:H{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("G1:G{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A1:H1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // 4. Wrap Text untuk kolom narasi
                $sheet->getStyle("D2:E{$lastRow}")->getAlignment()->setWrapText(true);
                $sheet->getStyle("F2:F{$lastRow}")->getAlignment()->setWrapText(true);

                // 5. Set Tinggi Baris (Ditinggikan jadi 100 agar foto & TTD punya ruang)
                for ($i = 2; $i <= $lastRow; $i++) {
                    $sheet->getDelegate()->getRowDimension($i)->setRowHeight(100);
                }
            },
        ];
    }
}
