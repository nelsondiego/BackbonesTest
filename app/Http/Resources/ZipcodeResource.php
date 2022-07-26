<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class ZipcodeResource extends JsonResource
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
            'zip_code' => $this->zip_code,
            'locality'=> Str::upper($this->locality),
            'federal_entity' => [
                'key' => $this->federal_entity_key,
                'name' => Str::upper($this->federal_entity_name),
                'code' => $this->federal_entity_code,
            ],
            'settlements' => SettelementsResource::collection($this->settlements),
            'municipality' => [
                'key' => $this->municipality_key,
                'name' => Str::upper($this->municipality_name)
            ]
        ];
    }

    public function boot()
    {
        JsonResource::withoutWrapping();
    }
}
