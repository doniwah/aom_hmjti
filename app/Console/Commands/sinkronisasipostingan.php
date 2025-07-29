<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PostinganService;


class sinkronisasipostingan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sinkronisasipostingan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(PostinganService $postinganService)
    {
        $postinganService->synchronizeposts();
        $this->info('Posts synchronized successfully.');
    }
}
