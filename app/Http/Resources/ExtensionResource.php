<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExtensionResource extends JsonResource
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
            'number' => $this->number,
            'user_owner' => [
                'id' => $this->user ? $this->user->id : '-',
                'name' => $this->user ? $this->user->name : '-',
                'department' => $this->user && $this->user->department ? $this->user->department->name : '-',
            ],
            'created_at' => $this->created_at->format('d/m/Y H:i:s')
        ];
    }
}
