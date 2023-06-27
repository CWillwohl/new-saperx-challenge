<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'phoneBook'     => new PhoneBookResource($this->phoneBook),
            'identify'      => $this->id,
            'birthday'      => $this->birthday,
            'phone'         => $this->phone,
            'email'         => $this->email,
            'name'          => $this->name,
            'cpf'           => $this->cpf,
        ];
    }
}
