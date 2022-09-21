<?php

namespace App\Models\Collections\Customer;

use App\Models\Collections\DataCollection;

/**
 * Customer Collection
 */
class CustomerSupplyCollection extends DataCollection
{
    /** Create Customer Fields */
    public const CREATE_CUSTOMER_SUPPLY_FIELDS = [
        'id',
        'customerId',
        'supplyId',
        'quantity'
    ];
    /** Update Customer Fields */
    public const UPDATE_CUSTOMER_SUPPLY_FIELDS = [
        'customerId',
        'supplyId',
        'quantity'
    ];

    /**
     * CustomerSupplyCollection Constructor Method
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
    public function getCreateCustomerSupplyDetails() 
    {   
        return $this->only(self::CREATE_CUSTOMER_SUPPLY_FIELDS);
    }

    /** Returns project details for update only
     * @return array
    */
    public function getUpdateCustomerSupplyDetails()
    {
        return $this->only(self::UPDATE_CUSTOMER_SUPPLY_FIELDS);
    }
}

