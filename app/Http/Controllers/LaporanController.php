<?php

namespace App\Http\Controllers;

use App\Exports\OfflineExport;
use App\Exports\Penjualanexport;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanController extends Controller
{
    public function index(){
        return view('pages.admin.laporan.indexlaporan');
    }
    public function export(Request $request){
    // dd($request->all());
    $confirmationFilter = $request->confirmation_filter;
    $presenceFilter = $request->presence_filter;
    $nama = ($request->nama_file != null) ? $request->nama_file : 'laporan';
    $tipefileexport = ($request->tipe_file != null) ? $request->tipe_file : 'xlsx';
    // tgl harian
    $tanggalstart = ($request->tanggal != null) ? Carbon::parse($request->tanggal)->format('Y-m-d') : date('Y-m-d');
    $tanggalend = ($request->tanggal_end != null) ? Carbon::parse($request->tanggal_end)->format('Y-m-d') : date('Y-m-d');

    $namafile = $nama.'.'.$tipefileexport;
    $tipeimportfile =null;
    switch ($tipefileexport) {
        case 'xlsx':
            $tipeimportfile = \Maatwebsite\Excel\Excel::XLSX;
            break;
        case 'csv':
            $tipeimportfile = \Maatwebsite\Excel\Excel::CSV;
            break;
        case 'pdf':
            $tipeimportfile = \Maatwebsite\Excel\Excel::MPDF;
            break;
        default:
            $tipeimportfile = \Maatwebsite\Excel\Excel::XLSX;
            break;
    }
    
    if($request->transaction_type == "website")
        {
            return Excel::download(new Penjualanexport($confirmationFilter, $presenceFilter), $namafile, $tipeimportfile);
        }
        else if($request->transaction_type == "offline")
        {

            return Excel::download(new OfflineExport(), $namafile, $tipeimportfile);
        }
    }
    public function styles(Worksheet $sheet)
    {

    }
    public function test(){
        $data = Transaction ::with('user','ticket','voucher','panitia')->orderBy('id_transaction','asc')->get();
        dd($data);
    }
}
