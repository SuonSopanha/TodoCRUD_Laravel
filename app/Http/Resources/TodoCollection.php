<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TodoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($todo) {
            return [
                'id' => $todo->id,
                'user_id' => $todo->user_id,
                'title' => $todo->title,
                'completed' => $todo->completed,
                'description' => $todo->description,
            ];
        })->toArray();
    }
}
