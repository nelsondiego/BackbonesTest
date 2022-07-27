<?php

namespace App\Http\Resources;

use App\Traits\Txf;
use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class SettelementsResource extends JsonResource
{
    use Txf;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'key' => $this->key,
            'name' => Txf::format($this->name),
            'zone_type' => Txf::format($this->zone_type),
            'settlement_type' => [
                'name' => $this->settlement_type_name,
            ]
        ];
    }

    
}
