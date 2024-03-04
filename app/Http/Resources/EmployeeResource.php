<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'id_no' => $this->id_no,
            'fname' => $this->fname,
            'mname' => $this->mname,
            'lname' => $this->lname,
            'address' => $this->address,
            'emp_type' => $this->emp_type,
            'profile_photo_path' => $this->profile_photo_path,
            'status' => $this->status,
            'role' => $this->user->roles[0]->name,
        ];
    }
}
