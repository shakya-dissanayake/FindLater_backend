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
        $is_favourite = $request->query('is_favourite');

        return [
            'id' => (String)$this->id,
            'attributes' => [
                'name' => $this->name,
                'is_favourite' => (String)$this->is_favourite,
                'description' => $this->description,
                'image' => $this->image,
                'coordinates' => $this->coordinates,
                'province' => $this->province,
                'address' => $this->address,
                'distance' => $this->distance,
                'by_car' => $this->by_car,
                'by_bike' => $this->by_bike,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ],
            'relationships' => [
                'user_id' => $this->user_id
            ]
        ];
    }
}
