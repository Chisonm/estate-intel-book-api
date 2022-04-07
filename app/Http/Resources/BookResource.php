<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // dd($this->resource);
        $url = $this->resource['url'];
        $fragments = explode('/', $url);
        $id = end($fragments);

        return [
            "id" => $id,
            "name" => $this->resource["name"],
            "isbn" => $this->resource["isbn"],
            "authors" => $this->resource["authors"],
            "publisher" => $this->resource["publisher"],
            "country" => $this->resource["country"],
            "number_of_pages" => $this->resource["numberOfPages"],
            "released_date" => $this->resource["released"],
        ];
    }
}
