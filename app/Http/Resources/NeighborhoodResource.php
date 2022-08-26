<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NeighborhoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => ucwords($this->status),
            'created_at' => \Carbon\Carbon::parse($this->created_at)->format('Y-m-d'),
            'updated_at' => \Carbon\Carbon::parse($this->updated_at)->format('Y-m-d'),
        ];
    }
}
