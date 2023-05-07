<?php

namespace App\Jobs;

use App\Models\Neighborhood;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateNeighborhoodContentWithAI implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $neighborhoodId;

    /**
     * Create a new job instance.
     *
     * @param  int  $neighborhoodId
     * @return void
     */
    public function __construct(int $neighborhoodId)
    {
        $this->neighborhoodId = $neighborhoodId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $neighborhood = Neighborhood::withoutGlobalScope('mine')->findOrFail($this->neighborhoodId);

        $message = "generate at least 200 words of content for {$neighborhood->name} located at {$neighborhood->address} {$neighborhood->city}, {$neighborhood->state} {$neighborhood->zip}";
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $message],
            ],
        ]);
        $neighborhood->update(['description' => $response['choices'][0]['message']['content']]);
    }
}
