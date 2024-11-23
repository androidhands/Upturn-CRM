<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'id'=> $this->id,
            'name'=> $this->name,
            'code'=>$this->code,
            'phoneCode'=>$this->phoneCode,
            'flagUrl'=>$this->flagUrl,
            'created_at'=>(new Carbon($this->created_at))->format('Y-m-d'),
            'updated_at'=>(new Carbon($this->updated_at))->format('Y-m-d'),
        ];
    }
}
