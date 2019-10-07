<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $ret = [
            'id' => $this->id,
            'name' => $this->name,
        ];
        foreach ($this->categories as $category) {
            $ret['categories'][] = ['id' => $category->id, 'name' => $category->name];
        }

        return $ret;
    }
}
