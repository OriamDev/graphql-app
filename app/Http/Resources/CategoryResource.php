<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'type' => 'categories',
            'id' => (string) $this->resource->getRouteKey(),
            'attributes' => [
                'name' => $this->resource->name,
                'slug' => $this->resource->slug,
                'status' => $this->resource->status
            ],
            'relationships' => [
                'products' => ProductCollection::make($this->resource->products)
            ],
            'links' => [
                'self' => route('api.categories.show', $this->resource)
            ]
        ];
    }
}
