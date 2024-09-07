<?php

namespace App\Jobs;

use App\Services\CurrencyCheckService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckCurrenciesJob implements ShouldQueue
{
    use Queueable;
    private $vars;
    private $startDate;
    private $endDate;
    private $period;

    /**
     * Create a new job instance.
     */
    public function __construct($vars, $startDate, $endDate, $period)
    {
        $this->vars = $vars;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->period = $period;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $check = new CurrencyCheckService();
        $isCheck = $check->check($this->vars, $this->startDate, $this->endDate, $this->period);

        SaveCurrenciesJob::dispatch($isCheck, $this->vars)->onQueue('saveCurrencies');
    }
}
