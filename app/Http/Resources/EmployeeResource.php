<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    //    wrap -> false make the returned object is a clear object ex {data:{}}-> {}
    public static $wrap = false;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'role_id' => $this->role_id,
            'department_id' => $this->department_id,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'education_degree' => $this->education_degree,
            'graduation_year' => $this->graduation_year,
            'military_status' => $this->military_status,
            'marital_status' => $this->marital_status,
            'hiring_date' => $this->hiring_date,
            'termination_date' => $this->termination_date,
            'created_at' => (new Carbon($this->created_at))->format('Y-m-d'),
            'updated_at' => (new Carbon($this->updated_at))->format('Y-m-d'),
            'is_active' => $this->is_active,
            'image_url' => $this->image_url,
            'role' => new RoleResource($this->whenLoaded('role')),
            'department' => new DepartmentResource($this->whenLoaded('departments'))
        ];
    }
}
