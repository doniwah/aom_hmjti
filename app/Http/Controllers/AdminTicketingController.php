<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SponsorshipService;
use App\Models\sponsorship_categori;
use App\Models\Sponsorships;
use App\Services\TicketingService;
use App\Models\OfflineTransaction;
use App\Services\TransactionService;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AdminTicketingController extends Controller
{
    public function index(TicketingService $service)
    {
        $transaction = $service->getTodayTransaction();
        return view('pages.admin.offline_ticketing.index',compact('transaction'));
    }
    public function store(Request $request,TicketingService $service, TransactionService $transactionService)
    {
        $validator = Validator::make($request->all(), [
            "nama_lengkap" => "required",
            "email" => "required|email",
            "nama_ticket" => "required|in:Gold,Silver",
            "tempat_penjualan" => "required"
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors()->all();
            Alert::error($messages[0])->flash();
            return back()->withErrors($validator)->withInput();
        }
        $service->submitTicketing($request->all(),  $transactionService);
        return redirect()->route("index.ticketing");
    }
      public function resendMail($id, TransactionService $transactionService)
    {
        $data = OfflineTransaction::findOrFail($id);
        $transactionService->sendOfflineTransactionEmail($data);
        return redirect()->route("index.ticketing");
    }

   
}
