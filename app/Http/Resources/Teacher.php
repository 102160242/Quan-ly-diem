<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Teacher extends JsonResource
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
            "id" => 1,
            "user" => new User($this->whenLoaded('user')),
            "academic_rank" => $this->academicRank != null ? $this->academicRank->name : null,
            "degree" => $this->degree != null ? $this->degree->name : null,
            "specialization" => $this->specialization != null ? $this->specialization->name : null,
            "faculty" => $this->faculty != null ? $this->faculty->name : null,
            "course_classes" => CourseClass::collection($this->whenLoaded('courseClasses')),
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at,
            "deleted_at"=> $this->deleted_at,
        ];
    }
}
