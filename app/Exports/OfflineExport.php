<?php

namespace App\Exports;

use App\Models\OfflineTransaction;
use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OfflineExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithEvents
{
    protected $no;
    protected $data;

    public function __construct($tanggalstart = null, $tanggalend = null)
    {
        $this->no = 1;
        // Modify to select all confirmation statuses and presence statuses
        $this->data = OfflineTransaction::orderBy('id', 'asc');
         // Set the tanggalstart and tanggalend properties
        $this->tanggalstart = $tanggalstart;
        $this->tanggalend = $tanggalend;
         if (!is_null($this->tanggalstart) && !is_null($this->tanggalend)) {
            $this->data->whereDate('created_at', '>=', $this->tanggalstart)
                       ->whereDate('created_at', '<=', $this->tanggalend);
        }
    }

    public function collection()
    {
        return $this->data->get();
    }

    public function styles(Worksheet $sheet)
    {
        return $sheet;
    }

    public function headings(): array
    {
        return [
            'No',
            'Nomer Transaksi',
            'Nama Pembeli',
            'Email Pembeli',
            'Tipe Tiket',
            'Kode Barcode',
            'Tempat Penjualan',
            'Tanggal Transaksi',
        ];
    }

    public function map($penjualan): array
    {
        // Mapping confirmation and presence statuses dynamically

        return [
            $this->no++,
            $penjualan->id,
            $penjualan->nama_lengkap,
            $penjualan->email,
            $penjualan->nama_ticket,
            $penjualan->kode_barcode,
            $penjualan->tempat_penjualan,
            $penjualan->created_at,
        ];
    }

    // Method to map confirmation statuses
  
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Header styling
                $sheet->getStyle('A1:H1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['argb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['argb' => '404040'],
                    ],
                ]);

                // Adding borders to all cells
                $sheet->getStyle('A1:H' . ($this->data->count() + 1))->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);

            },
        ];
    }
}
