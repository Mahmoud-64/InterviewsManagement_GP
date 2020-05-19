<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
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
            'title'=>$this->title,
            'description'=>$this->description,
            'seniority'=>$this->seniority,
            'years_exp'=>$this->years_exp,
            'requirements' => JobRequirementResource::collection($this->requirements)

        ];
    }
}
