<?php

namespace App\Http\Resources;

use App\Traits\Txf;
use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class ZipcodeResource extends JsonResource
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
            'zip_code' => $this->zip_code,
            'locality'=> Txf::format($this->locality),
            'federal_entity' => [
                'key' => $this->federal_entity_key,
                'name' => Txf::format($this->federal_entity_name),
                'code' => $this->federal_entity_code,
            ],
            'settlements' => SettelementsResource::collection($this->settlements),
            'municipality' => [
                'key' => $this->municipality_key,
                'name' => Txf::format($this->municipality_name)
            ]
        ];
    }

    
}
