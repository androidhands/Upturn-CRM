<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
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
            'name' => $this->name,
            'email' => $this->email,
            'type' => $this->type,
            'company_id' => $this->company_id,
            'verified' => $this->hasVerifiedEmail(),
            'created_at' => (new Carbon($this->created_at))->format('Y-m-d'),
            'employee' => new EmployeeResource($this->whenLoaded('employee')),
        ];
    }
}
