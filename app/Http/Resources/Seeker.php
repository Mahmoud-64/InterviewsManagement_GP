<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Seeker extends JsonResource
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
            'email' => $this->email,
            'password' => $this->password,
            'details' => [
              'address' => $this->userable->address,
              'city' => $this->userable->city,
              'seniority' => $this->userable->seniority,
              'expYears' => $this->userable->expYears,
              'currentJob' => $this->userable->currentJob,
              'currentSalary' => $this->userable->currentSalary,
              'expectedSalary' => $this->userable->expectedSalary,
              'cv' => $this->userable->cv,
            ]
        ];
    }
}