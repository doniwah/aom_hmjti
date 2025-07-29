<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SetTimelimitTransaction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:set-timelimit-transaction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set transactions to inactive if they are not paying after older than 2 hour and have status 0 and bukti_transaction is null';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try{
            $transactions = Transaction::with('user')
        ->where('confirmation', 0)
        ->whereNull("bukti_pembayaran")
        ->whereRaw('NOW() > created_at + INTERVAL 2 HOUR')
        ->get();

        if(count($transactions) > 0)
        {
            // Extract emails from the transactions
            $dataEmail = $transactions->map(function ($transaction) {
                return [
                    'name' => $transaction->user->name,
                    'email' => $transaction->user->email,
                    'url' => route('verifikasiPembayaran', $transaction->id_transaction),
                ];
            });
        

            // Update the transactions
            Transaction::whereIn('id_transaction', $transactions->pluck('id_transaction'))
                ->update([
                    'confirmation' => 1,
                    'updated_at' => now()
                ]);

                foreach($dataEmail as $data)
                {
                    $service->sendUserConfirmMail(1, $data);
                }
                $this->info('Timelimit transactions have been updated.' . $dataEmail. count($dataEmail));
        }else{
            $this->info('There is no timelimited transaction');
        }
        }catch(Exception $e)
        {
            $this->info($e);   
        }
    }
}
