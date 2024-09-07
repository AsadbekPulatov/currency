<?php

namespace App\Console\Commands;

use App\Jobs\GetCurrenciesJob;
use Illuminate\Console\Command;

class GetCurrenciesAutomaticCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-currencies-automatic-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $startDate = date('Y-m-d');
        $endDate = $startDate;

        GetCurrenciesJob::dispatch($startDate, $endDate)->onQueue('getCurrencies');
    }
}
