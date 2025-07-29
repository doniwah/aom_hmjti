<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Services\VoucherService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers = voucher::all();
        return view('pages.admin.voucher.voucher',compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,VoucherService $voucherService)
    {
        $request->validate([
            'kode' => 'required',
            'name' => 'required',
            'quantity' => 'required',
            'discount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $voucherData = [
            'kode' => $request->kode,
            'name' => $request->name,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
        ];
        $cek = $voucherService->storevoucher($voucherData);
        if($cek){
            toast('Data berhasil ditambahkan!', 'success');
            return redirect()->route('Voucher.index');
        }else{
            toast('Data gagal ditambahkan!', 'error');
            return redirect()->route('Voucher.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(voucher $voucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(voucher $voucher)
    {
        $voucher = $voucher->first();
        return view('pages.admin.voucher.editvoucher',compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_voucher,VoucherService $voucherService)
    {
        $request->validate([
            'kode' => 'required',
            'name' => 'required',
            'quantity' => 'required',
            'discount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $voucherData = [
            'kode' => $request->kode,
            'name' => $request->name,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
        ];
        $cek = $voucherService->updatevoucher($voucherData,$id_voucher);
        if($cek){
            toast('Data berhasil diubah!', 'success');
            return redirect()->route('Voucher.index');
        }else{
            toast('Data gagal diubah!', 'error');
            return redirect()->route('Voucher.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_voucher, VoucherService $voucherService)
    {
        $cek = $voucherService->deletevoucher($id_voucher);
        if ($cek) {
            toast('Data berhasil dihapus!', 'success');
            return redirect()->route('Voucher.index');
        } else {
            toast('Data gagal dihapus!', 'error');
            return redirect()->route('Voucher.index');
        }
    }
    public function getData($id)
    {
        $currentDate = now()->format('Y-m-d');

        $data = Voucher::where('kode', $id)
            ->where('quantity', '>', 0)
            ->whereDate('start_date', '<=', $currentDate)
            ->whereDate('end_date', '>=', $currentDate)
            ->first();
        return response()->json(["data" => $data]);
    }
}
