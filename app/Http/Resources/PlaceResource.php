<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
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
            'id' => (String)$this->id,
            'attribures' => [
                'image' => $this->image,
                'name' => $this->name,
                'description' => $this->description,
                'is_favourite' => (String)$this->is_favourite,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'province' => $this->province,
                'address' => $this->address,
                'distance' => $this->distance,
                'by_car' => $this->by_car,
                'by_public_transport' => $this->by_public_transport,
                'updated_at' => $this->updated_at
            ]
        ];
    }
}
