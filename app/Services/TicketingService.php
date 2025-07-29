<?php
namespace App\Services;

use App\Models\OfflineTransaction;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TicketingService{
    public function getTodayTransaction(){
        $data = OfflineTransaction::whereDate("created_at", Carbon::now()->toDateString())->orderBy("created_at", "DESC")->get();
            return $data;
    }
    public function submitTicketing( $data,TransactionService $transactionService)
    {
        $data["kode_barcode"] = Str::lower(Str::random(10));
        $data["status"] = "belum";
        $data["presence"] = 0;
        $data["tempat_penjualan"] = Str::lower($data["tempat_penjualan"]);
        $transaction = OfflineTransaction::create($data);
        $data["id"] = $transaction->id;
        
        $transactionService->sendOfflineTransactionEmail($data);
    }
}
