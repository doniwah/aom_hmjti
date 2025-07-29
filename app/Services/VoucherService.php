<?php

namespace App\Services;

use App\Models\voucher;

class VoucherService
{
    public function getallvoucher(){
        $vouchers = voucher::all();
        return $vouchers;
    }
    public function getvoucherbyid($id){
        $voucher = voucher::find($id);
        return $voucher;
    }
    public function storevoucher($data){
        if (!$data) {
            return false;
        }
        $datas = voucher::create([
            'kode' => $data[ 'kode'],
            'name' => $data[ 'name'],
            'quantity' => $data[ 'quantity'],
            'discount' => $data['discount'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);

        return true;
    }

    public function updatevoucher($data, $id){
        $voucher = voucher::find($id);
        if (!$voucher) {
            return false;
        }
        $voucher->update([
            'kode' => $data[ 'kode'],
            'name' => $data[ 'name'],
            'quantity' => $data[ 'quantity'],
            'discount' => $data['discount'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);
        return true;
    }

    public function deletevoucher($id){
        $voucher = voucher::find($id);
        if (!$voucher) {
            return false;
        }
        $voucher->delete();
        return true;
    }
}
