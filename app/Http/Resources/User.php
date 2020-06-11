<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'verify_email'=> $this->email_verified_at? true : false,
            'image'=> $this->image ? action('UserController@renderPhoto', ['photo' => $this->image]) : null,
            'role' => $this->roles->pluck('name'),
        ];
    }
}
