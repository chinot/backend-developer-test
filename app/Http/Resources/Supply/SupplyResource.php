<?php

namespace App\Http\Resources\Supply;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class SupplyResource extends JsonResource
{
    /**
     * Unwraps response from data key
     */
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $url = URL::current();

        $links = [
            '_links' => [
                'self' => [
                    'href' => url("{$url}/{$this->id}")
                ]
            ]
        ];

        $supplyDetails = collect($this->resource)->toArray();
        $data = array_merge($supplyDetails, $links);

        return array_merge($data);
    }
}
