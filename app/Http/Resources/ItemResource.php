<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'id' => $this->_id,
            'description' => $this->description,
            'image_link' => route('item.image', ['id' => $this->id, 'nocache' => $this->updated_at->timestamp])
        ];
    }
}
