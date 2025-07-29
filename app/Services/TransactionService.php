<?php
namespace App\Services;

use App\Mail\BelumBayarMail;
use App\Mail\OfflineTransactionMail;
use App\Models\Transaction;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserConfirmMail;
use App\Models\BelumBayar;
use Illuminate\Support\Facades\DB;
use App\Models\OfflineTransaction;
use App\Models\User;
use Midtrans\Config;
use Illuminate\Support\Str;
class TransactionService{
    public function gettransactionbysales()
    {
        
        $web_transaction = Transaction::select(
                DB::raw("CASE WHEN ticket.name != sales_in THEN CONCAT(ticket.name, ' ', sales_in) ELSE ticket.name END AS name_ticket"),
                DB::raw("COUNT(transaction.id_transaction) AS transaction_count"),
                DB::raw("MAX(transaction.created_at) AS last_transaction")
            )
            ->join('ticket', 'ticket.idTicket', '=', 'transaction.id_ticket')
            ->where('transaction.confirmation', 2)
            ->groupBy('transaction.id_ticket', 'ticket.name', 'ticket.sales_in')
            ->having('transaction_count', '!=', 0)
            ->orderBy('ticket.idTicket')
            ->get();

        
        $offline_transaction = OfflineTransaction::select(
            DB::raw("CONCAT(nama_ticket, ' ', 'Offline') as name_ticket"),
            DB::raw("COUNT(id) as transaction_count"),
            DB::raw("MAX(offlinetransaction.created_at) AS last_transaction")
        )
        ->groupBy('nama_ticket')
        ->get();
        $data = $web_transaction->concat($offline_transaction);
        return $data;
    }
    public function gettransactionbycodebarcodeandemail($codebarcode, $email)
    {

        $combinedQuery = DB::table('offlinetransaction')
            ->select([
                'id as id_transaction',
                'kode_barcode',
                'nama_lengkap',
                'email',
                'nama_ticket',
                'presence',
                DB::raw("'offlinetransaction' as source_table")
            ])
            ->unionAll(
                DB::table('transaction')
                    ->join('users', 'users.id', '=', 'transaction.id_user')
                    ->join('ticket', 'ticket.idTicket', '=', 'transaction.id_ticket')
                    ->select([
                        'transaction.id_transaction',
                        'transaction.kode_barcode',
                        'users.name as nama_lengkap',
                        'users.email as email',
                        'ticket.name as nama_ticket',
                        'transaction.presence',
                        DB::raw("'transaction' as source_table")
                    ])
            );

        // Wrap the union query as a subquery to apply `where` across all results
        $result = DB::table(DB::raw("({$combinedQuery->toSql()}) as combined"))
            ->mergeBindings($combinedQuery) // Merge bindings to avoid SQL errors
            ->where('kode_barcode', '=', $codebarcode)
            ->orWhere('email', '=', $email)
            ->first();

        return $result;
    }
    public function gettransactionbyidandemail($idtransaction,$email){
        $data = transaction::with('user','ticket')->limit(1)->where('id_transaction',$idtransaction)->orwhereHas('user', function ($query) use ($email) {
            $query->where('email', $email);
        });
            return $data;
    }
    public function gettransactionwithmidtrans($idtransaction){
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        // dd($transactionId);
        $response = \Midtrans\Transaction::status($idtransaction);
        // dd($response);

        if ($response->status_code == 200) {
            $transactionData = [
                'status_code' => $response->status_code ?? null,
                'status_message' => $response->status_message ?? null,
                'transaction_id' => $response->transaction_id ?? null,
                'order_id' => $response->order_id ?? null,
                'gross_amount' => $response->gross_amount ?? null,
                'currency' => $response->currency ?? null,
                'payment_type' => $response->payment_type ?? null,
                'transaction_status' => $response->transaction_status ?? null,
                'signature_key' => $response->signature_key ?? null,
                'fraud_status' => $response->fraud_status ?? null,
                'merchant_id' => $response->merchant_id ?? null,
                'transaction_type' => $response->transaction_type ?? null,
                'issuer' => $response->issuer ?? null,
                'acquirer' => $response->acquirer ?? null,
                'transaction_time' => $response->transaction_time ?? null,
                'settlement_time' => $response->settlement_time ?? null,
                'expiry_time' => $response->expiry_time ?? null,
            ];
            return $transactionData;
        }

        return null;
    }
    public function gettransaction(){
        $data = transaction::with('user','ticket','voucher','panitia');
        return $data;
    }
    public function sendUserConfirmMail($confirmCode, $dataEmail)
    {
        // check confirm code
        switch ($confirmCode):
            case 1:
                $dataEmail['button'] = 'Upload Ulang';
                $dataEmail['img'] = 'img/ticket_mail/ditolak.png';
                $dataEmail['color'] = '#D61F47';
                $dataEmail['text'] = 'Ditolak';
                $dataEmail['text2'] = 'Kami mohon maaf untuk memberitahukan bahwa pembayaran tiket konser Art Of Manunggalan 10 Anda telah ditolak oleh sistem kami. Silakan hubungi tim di +62 852-1670-9554 dengan melampirkan bukti pembayaran Anda untuk menyelesaikan pembayaran dan mendapatkan tiket Anda.';
                $dataEmail['text3'] = 'Untuk Melakukan proses verifikasi Ulang pembayaran tiket konser, silakan unggah bukti pembayaran Anda di website Art Of Manunggalan 10';

                break;
            case 3:
                $dataEmail['img'] = 'img/ticket_mail/ditolak.png';
                $dataEmail['color'] = '#D61F47';
                $dataEmail['text'] = 'Tiket Hangus';
                $dataEmail['text2'] = 'Kami mohon maaf untuk memberitahukan bahwa tiket konser Art Of Manunggalan 10 Anda telah hangus oleh sistem kami karena telah melebihi tenggat waktu pembayaran. Silakan hubungi tim di +62 852-1670-9554 jika terdapat kesalahan pada sistem kami.';
                $dataEmail['text3'] = 'Silakan buat transaksi baru di website Art Of Manunggalan 10';
                break;
            default:
            $dataEmail['img'] = 'img/ticket_mail/berhasil.png';
                $dataEmail['button'] = 'Lihat Tiket';
                $dataEmail['color'] = '#1EE0AC';
                $dataEmail['text'] = 'Berhasil';
                $dataEmail['text2'] = 'Pembayaran tiket konser Art Of Manunggalan 10 Anda telah diverifikasi oleh admin. Terima kasih atas kesabaran Anda.Silakan simpan bukti pembayaran Anda untuk berjaga-jaga. Nikmati konsernya!';
                $dataEmail['text3'] = 'Silahkan Melakukan Pengambilan Tiket di lokasi yang telah ditentukan.';
                break;
        endswitch;

        $send = Mail::to($dataEmail['email'])->send(new UserConfirmMail($dataEmail));

        return $send;
    }
    public function sendOfflineTransactionEmail($dataEmail)
    {
        $dataEmail['img'] = 'img/ticket_mail/berhasil.png';
        $dataEmail['button'] = 'Lihat Tiket';
        $dataEmail['color'] = '#1EE0AC';
        $dataEmail['text'] = 'Berhasil';
        $dataEmail['text2'] = 'Hai '. $dataEmail["nama_lengkap"].', Pembayaran tiket konser Art Of Manunggalan 10 Anda telah diverifikasi oleh admin. Terima kasih atas kesabaran Anda. Silakan simpan bukti pembayaran Anda untuk berjaga-jaga. Nikmati konsernya!';
        $dataEmail['text3'] = 'Silahkan scan kode barcode pada file dibawah ini untuk melakukan pengambilan tiket di lokasi yang telah ditentukan.';   
        try{
             $send = Mail::to($dataEmail["email"])->send(new OfflineTransactionMail($dataEmail));
              $transaction = OfflineTransaction::findOrFail($dataEmail['id']);
            if ($transaction) {
                $transaction->status = "sudah"; // Assuming Sudah means successful
                $transaction->save();
            }
            return $send;
        }catch(Exception $e)
        {
            Log::error('Sending Email Failed' . $e->getMessage());
            $transaction = OfflineTransaction::findOrFail($dataEmail["id"]);
            if($transaction)
            {
                $transaction->status = "belum";
                $transaction->save();
            }
        }
       
    }
    public function sendBelumBayarEmail($dataEmail)
    {
        $dataEmail['img'] = 'img/ticket_mail/ditolak.png';
        $dataEmail['color'] = '#D61F47';
        $dataEmail['text'] = 'Transaksi Ditahan';
        $dataEmail['text2'] = 'Halo sobat Arta!,
                                Sepertinya sobat Arta belum melakukan pembayaran untuk tiket AOM nih!.
                                Cek tiketmu di website yaaa, jangan sampai kehabisan! 
                                ';
        $dataEmail['text3'] = 'Tiket akan hangus apabila tidak melakukan pembayaran selama 1x24 jam mulai pemberitahuan ini dikirim.';   
        try{
            $send = Mail::to($dataEmail["email"])->send(new BelumBayarMail($dataEmail));
             $transaction = BelumBayar::findOrFail($dataEmail['id']);
           if ($transaction) {
               $transaction->status = 1; // Assuming Sudah means successful
               $transaction->save();
           }
           return $send;
       }catch(Exception $e)
       {
           $transaction = BelumBayar::findOrFail($dataEmail["id"]);
           if($transaction)
           {
               $transaction->status = 0;
               $transaction->save();
           }
       }
    }
    public function show($code, $role)
    {
        // convertion role
        $role = $this->userRole($role);

        // get user by code and role
        $user = User::where('role', $role)
            ->where('code', $code)
            ->first();

        return $user;
    }

    public function confirmtransaction($id, $confirmCode,$status)
    {
        $transaction = $this->gettransactionbyidandemail($id,null)->first();
        $data = [
            'confirmation' => $confirmCode,
            'status' => $status, 
        ];
        if($confirmCode == '2'  && !Str::contains($transaction->ticket->sales_in, 'Bundle'))
        {
            $data["kode_barcode"] = Str::random(10);
        }
        $transaction->update($data);
        return $this->gettransactionbyidandemail($id,null);
    }

    public function presenced($user)
    {
        $user->presence = 1;
        $user->save();

        return $user;
    }
}
?>
