<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UniversityClass as ClassResource;

class User extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'university_classes' => ClassResource::collection($this->whenLoaded('university_classes')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
    public function with($request)
    {
        return [
            'university_classes' => ClassResource::collection($this->whenLoaded('university_classes')),
            ];
    }
}
