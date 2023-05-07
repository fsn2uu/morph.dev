<?php

namespace App\Jobs;

use App\Models\Unit;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateUnitContentWithAI implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $unitId;

    /**
     * Create a new job instance.
     *
     * @param  int  $unitId
     * @return void
     */
    public function __construct(int $unitId)
    {
        $this->unitId = $unitId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $unit = Unit::withoutGlobalScope('mine')->findOrFail($this->unitId);

        $message = "generate at least 200 words of content for {$unit->name} located at {$unit->address} {$unit->city}, {$unit->state} {$unit->zip}";
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $message],
            ],
        ]);
        $unit->update(['description' => $response['choices'][0]['message']['content']]);
    }
}
