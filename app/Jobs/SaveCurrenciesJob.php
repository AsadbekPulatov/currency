<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveCurrenciesJob implements ShouldQueue
{
    use Queueable;
    private $isCheck;
    private $vars;

    /**
     * Create a new job instance.
     */
    public function __construct($isCheck, $vars)
    {
        $this->isCheck = $isCheck;
        $this->vars = $vars;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $x = new \App\Services\CurrencySaveService();
        $x->syncSave($this->isCheck, $this->vars);
    }
}
