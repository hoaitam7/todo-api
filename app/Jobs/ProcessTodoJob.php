<?php

namespace App\Jobs;

use App\Models\Todo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessTodoJob implements ShouldQueue
{
    use Queueable;
    public $todo;

    /**
     * Create a new job instance.
     */
    public function __construct(Todo $todo)
    {
        //
        $this->todo = $todo;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        Log::info("trước khi xử lý cv: {$this->todo->id}");
        sleep(15);
        Log::info("Sau khi xủ lý: {$this->todo->id}");
    }
}
