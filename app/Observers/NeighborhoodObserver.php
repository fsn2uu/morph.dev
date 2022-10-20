<?php

namespace App\Observers;

use App\Models\Neighborhood;

class NeighborhoodObserver
{
    /**
     * Handle the Neighborhood "created" event.
     *
     * @param  \App\Models\Neighborhood  $neighborhood
     * @return void
     */
    public function created(Neighborhood $neighborhood)
    {
        //
    }

    /**
     * Handle the Neighborhood "updated" event.
     *
     * @param  \App\Models\Neighborhood  $neighborhood
     * @return void
     */
    public function updated(Neighborhood $neighborhood)
    {
        //
    }

    /**
     * Handle the Neighborhood "deleted" event.
     *
     * @param  \App\Models\Neighborhood  $neighborhood
     * @return void
     */
    public function deleted(Neighborhood $neighborhood)
    {
        //
    }

    /**
     * Handle the Neighborhood "restored" event.
     *
     * @param  \App\Models\Neighborhood  $neighborhood
     * @return void
     */
    public function restored(Neighborhood $neighborhood)
    {
        //
    }

    /**
     * Handle the Neighborhood "force deleted" event.
     *
     * @param  \App\Models\Neighborhood  $neighborhood
     * @return void
     */
    public function forceDeleted(Neighborhood $neighborhood)
    {
        //
    }
}
