<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomerCollection extends ResourceCollection
{
    /** Reponse meta data */
    private $responseMetaData;

    /** Response links */
    private $responseLinks;

    /**
     * Unwraps response from data key
     */
    public static $wrap = null;

    public function __construct($resource)
    {
        $this->responseMetaData = $this->prepareMetaData($resource);
        $this->responseLinks = $this->prepareLinks($resource);
        $resource = $resource->getCollection();
        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $embeddings = [
            'supplies' => $this->collection
        ];
        
        return array_merge($this->responseMetaData, $this->responseLinks, $embeddings);
    }

    /**
     * Prepares Meta Data in Response
     * @param $resource array
     * @return array
     */
    private function prepareMetaData($resource)
    {
        return [
            '_meta' => [
                "count" => $resource->count(), 
                "total" => $resource->total(),
                "pages" => $resource->lastPage()
            ]
        ];

    }

    /**
     * Prepares links in Response
     * @param $resource array
     * @return array
     */
    private function prepareLinks($resource)
    {
        return [
            '_links' => [
                "first" => [
                    'href' => $resource->url(1)
                ],
                "last" => [
                    'href' => $resource->url($resource->lastPage())
                ],
                "self" => [
                    'href' => $resource->url($resource->currentPage())
                ],
                "prev" => [
                    'href' => $resource->previousPageUrl()
                ],
                "next" => [
                    'href' => $resource->nextPageUrl()
                ]
            ]
        ];
    }
}
