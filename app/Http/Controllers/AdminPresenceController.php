<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use GuzzleHttp\Client;
use Midtrans\Config;
use Midtrans\Transaction;

class AdminPresenceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(UserService $userService)
    {
        return view('pages.admin.presence');
    }

    public function getuserdata(transactionService $transactionservice, Request $request)
    {
        $datauser = $transactionservice->gettransactionbycodebarcodeandemail($request->code, $request->email);
        if (!empty($datauser)) {
            return response()->json($datauser);
        } else {
            return response()->json(null);
        }
    }

    // process precensing / use tikcet
    public function presence(transactionService $transactionService, Request $request)
    {
        $data = $transactionService->gettransactionbycodebarcodeandemail($request->code, null);
        // dd($data);
        if ($data) {
            if ($data->source_table === 'offlinetransaction') {
                DB::table('offlinetransaction')
                    ->where('id', $data->id_transaction)
                    ->update(['presence' => 1]);
            } elseif ($data->source_table === 'transaction') {
                DB::table('transaction')
                    ->where('id_transaction', $data->id_transaction)
                    ->update(['presence' => 1]);
            }
        }
        toast('Konfirmasi Tiket Pengguna Berhasil!', 'success');
        return redirect()->route('admin.presence');
    }

}
