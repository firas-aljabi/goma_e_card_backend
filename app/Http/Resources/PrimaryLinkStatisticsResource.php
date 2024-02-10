<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrimaryLinkStatisticsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'primary_link_id' => $this->id,
            'logo' => url($this->logo),
            'name' => $this->name,
           'visit' => 0
        ];
    }
}
