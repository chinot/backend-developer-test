<?php

namespace App\Models\Collections\Supply;

use App\Models\Collections\DataCollection;

/**
 * Supply Collection
 */
class SupplyCollection extends DataCollection
{
    /** Create Supply Fields */
    public const CREATE_SUPPLY_FIELDS = [
        'id',
        'supply',
        'points'
    ];

    /** Update Supply Fields */
    public const UPDATE_SUPPLY_FIELDS = [
        'supply',
        'points'
    ];

    /**
     * SupplyCollection Constructor Method
     * @param $rules array
     * @param $items array
     */
    public function __construct(array $rules = [], array $items = [])
    {
        Parent::__construct($rules, $items);
    }

    /** Returns project details for create only
    * @return array
    */
    public function getCreateSupplyDetails()
    {
        return $this->only(self::CREATE_SUPPLY_FIELDS);
    }

    /** Returns project details for update only
     * @return array
    */
    public function getUpdateSupplyDetails()
    {
        return $this->only(self::UPDATE_SUPPLY_FIELDS);
    }
}