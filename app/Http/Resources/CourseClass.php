<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Course as CourseResource;
use App\Http\Resources\Teacher as TeacherResource;

class CourseClass extends JsonResource
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
            "course" => new CourseResource($this->whenLoaded('course')),
            "name" => $this->name,
            $this->mergeWhen($this->relationLoaded('teacher') == false, [
                "teacher" => [
                    "id" => $this->teacher->id,
                    "name" => $this->teacher->user->name,
                ]]
           ),
            $this->mergeWhen($this->relationLoaded('teacher'), [ "teacher" => new TeacherResource($this->teacher)]),
            "total_students" => $this->students->count(),
            "credits" => $this->credits,
            "year" => $this->year,
            "semester" => $this->semester,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
