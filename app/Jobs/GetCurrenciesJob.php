<?php

namespace App\Jobs;

use App\Client\CurrencyClient;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetCurrenciesJob implements ShouldQueue
{
    use Queueable;

    private $startDate;
    private $endDate;
    private $period;


    /**
     * Create a new job instance.
     */
    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->period = new DatePeriod(
            new DateTime($startDate),
            new DateInterval('P1D'), // Interval of 1 day
            (new DateTime($endDate))->modify('+1 day') // Include the end date
        );
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->period as $date) {
            $formattedDate = $date->format('Y-m-d');
            $data = new CurrencyClient($formattedDate);
            $vars[$formattedDate] = $data->getCurrencies();
        }

        CheckCurrenciesJob::dispatch($vars, $this->startDate, $this->endDate, $this->period)->onQueue('checkCurrencies');
    }
}
