<?php

namespace Modules\Core\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'username' => $this->username,
            'email' => $this->email,
            'profile_picture' => $this->profile_picture,
        ];
    }
}
