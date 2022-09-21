<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class SuppliesResource extends JsonResource
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
                    'href' => url("{$url}")
                ]
            ]
        ];

        $customerDetails = collect($this->resource)->toArray();
        $data = array_merge($customerDetails, $links);

        return array_merge($data);
    }
}
