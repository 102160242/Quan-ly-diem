<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UniversityClass as ClassResource;

class Student extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            "id" => $this->id,
            "name" => $this->name,
            "gender" => $this->gender,
            "birthday" => $this->birthday,
            "phone_number" => $this->phone_number,
            "email" => $this->email,
            "university_class" => new ClassResource($this->whenLoaded('universityClass')),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "deleted_at" => $this->deleted_at,
        ];
    }
}
