<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreateBookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {


        return [
            "id" => $this->id,
            "name" => $this->name,
            "isbn" => $this->isbn,
            "authors" => $this->authors,
            "publisher" => $this->publisher,
            "country" => $this->country,
            "number_of_pages" => $this->number_of_pages,
            "released_date" => $this->released_date,
        ];
    }
}
