<?php

namespace App\Console\Commands;

use Exception;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SetInactiveTransaction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:set-inactive-transaction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set transactions to inactive if they are older than 1 day and have status 1';

    /**
     * Execute the console command.
     */
    public function handle(TransactionService $service)
    {
        try {
            $transactions = Transaction::with('user')
                ->where('confirmation', 1)
                ->whereRaw('NOW() > created_at + INTERVAL 1 DAY')
                ->get();

            if (count($transactions) > 0) {
                // Extract emails from the transactions
                $dataEmail = $transactions->map(function ($transaction) {
                    return [
                        'name' => $transaction->user->name,
                        'email' => $transaction->user->email,
                        "url" => ""
                    ];
                });

                // Update the transactions
                Transaction::whereIn('id_transaction', $transactions->pluck('id_transaction'))
                    ->update([
                        'confirmation' => 3,
                        'updated_at' => now()
                    ]);

                foreach ($dataEmail as $data) {
                    $service->sendUserConfirmMail(3, $data);
                }
                $this->info('Inactive transactions have been updated.' . $transactions);
            } else {
                $this->info('There is no inactive transactions ');
            }
        } catch (Exception $e) {
            $this->info($e);
        }
    }
}
