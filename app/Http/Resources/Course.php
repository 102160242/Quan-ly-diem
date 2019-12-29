<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CourseClass as CourseClassResource;

class Course extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "course_classes" => CourseClassResource::collection($this->whenLoaded('courseClasses')),
            "total_course_classes" => $this->courseClasses->count(),
        ];
    }
}
