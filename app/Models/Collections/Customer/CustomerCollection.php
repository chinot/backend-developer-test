<?php

namespace App\Models\Collections\Customer;

use App\Models\Collections\DataCollection;

/**
 * Customer Collection
 */
class CustomerCollection extends DataCollection
{
    /** Create Customer Fields */
    public const CREATE_CUSTOMER_FIELDS = [
        'id',
        'name',
        'gender',
        'status',
        'age'
    ];

    /** Update Customer Fields */
    public const UPDATE_CUSTOMER_FIELDS = [
        'name',
        'gender',
        'status',
        'age'
    ];

    /**
     * CustomerCollection Constructor Method
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
    public function getCreateCustomerDetails()
    {
        return $this->only(self::CREATE_CUSTOMER_FIELDS);
    }

    /** Returns project details for update only
     * @return array
    */
    public function getUpdateCustomerDetails()
    {
        return $this->only(self::UPDATE_CUSTOMER_FIELDS);
    }
}