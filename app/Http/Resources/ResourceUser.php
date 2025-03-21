<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceUser extends JsonResource
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
            'role' => $this->role,
            'name' => $this->name,
            'email' => $this->email,
            'company_name' => $this->company_name,
            'created_at' => $this->created_at->format('d F, Y H:i'),
            'updated_at' => $this->updated_at->format('d F, Y H:i'),
            // Add more attributes as needed
        ];
    }
}
