<?php

namespace App\Jobs;

use App\Models\PageView;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class RecordPageView implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected ?string $routeName, protected ?string $locale)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $record = new PageView();
        $record->route_name = $this->routeName;
        $record->locale = $this->locale;
        $record->save();
    }
}
