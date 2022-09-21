<?php

namespace App\Services\Customer;

use App\Models\Collections\Customer\CustomerCollection;
use App\Models\Query\Customer\Customer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str as UniqueString;

/**
 * Customer Service Class that contains Customer BL
 */
class CustomerService
{

    private $uniqueStringId;

    private $idStringLength = 30;

    private $totalPageRecord = 10;

    public function __construct(UniqueString $uniqueStringId)
    {
        $this->uniqueStringId = UniqueString::random($this->idStringLength);
    }

    /**
     * Creates new Customer
     * @param $customerDetails array
     * @return Customer
     */
    public function createCustomer(array $customerDetails)
    {   
        $customerData['id'] = $this->uniqueStringId;
        $customerData['name'] = $customerDetails['name'];
        $customerData['status'] = $customerDetails['status'];
        $customerData['age'] = $customerDetails['age'];
        $customerData['gender'] = $customerDetails['gender'];

        $customerCollection = $this->collectcustomerDetails($customerData);
       
        $newCustomer = Customer::create($customerCollection->getCreatecustomerDetails());
        return $newCustomer;
    }

    /**
     * Get a Customer
     * @param $CustomerId string
     */
    public function getCustomer(string $CustomerId)
    {
        return Customer::getCustomer($CustomerId);
    }

    /**
     * Updates existing Customer
     * @param $CustomerId string
     * @param $customerDetails array
     * @return Customer
     */
    public function updateCustomer(string $CustomerId, array $customerDetails)
    {
        $CustomerCollection = $this->collectcustomerDetails($customerDetails);
        $updatedCustomer = Customer::updateCustomer($CustomerId, $CustomerCollection->getUpdatecustomerDetails());
        return $updatedCustomer->refresh();
    }

    /**
     * Lists all Supplies
     * @return Customer
     */
    public function listSupplies()
    {
        return Customer::paginate($this->totalPageRecord);
    }


    /**
     * Stores Customer details into collection
     * @param $customerDetails array
     * @return CustomerCollection
     */
    private function collectcustomerDetails(array $customerDetails)
    {
        return app()->make(CustomerCollection::class, [
            'items' => $customerDetails
        ]);
    }
}
