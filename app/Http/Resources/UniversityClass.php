<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Student as StudentResource;

class UniversityClass extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'academic_year' => $this->academic_year,
            'head_users' => UserResource::collection($this->whenLoaded('headUsers')),
            'students' => StudentResource::collection($this->whenLoaded('students')),
            'total_students' => $this->totalStudents(),
        ];
    }
}
