<?php

namespace App\Console\Commands;

use App\Jobs\GetCurrenciesJob;
use Illuminate\Console\Command;

class GetCurrenciesCustomCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-currencies-custom-command {startDate} {endDate?}';

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
        $startDate = $this->argument('startDate');
        $endDate = $this->argument('endDate');
        if (!isset($endDate)){
            $endDate = $startDate;
        }

        GetCurrenciesJob::dispatch($startDate, $endDate)->onQueue('getCurrencies');
    }
}
