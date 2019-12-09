<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UniversityClass as ClassResource;
use Illuminate\Support\Facades\Storage;

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
            'gender' => $this->gender,
            'birthday' => \Carbon\Carbon::parse($this->birthday)->format('d/m/Y'),
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'avatar_url' => asset(Storage::url($this->avatar)),
            'is_admin' => $this->roles->isAdmin(),
            'is_teacher' => $this->roles->isTeacher(),
            'university_classes' => ClassResource::collection($this->whenLoaded('university_classes')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
