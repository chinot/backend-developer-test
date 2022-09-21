<?php

namespace App\Services\Customer;

use App\Models\Collections\Customer\CustomerSupplyCollection;
use App\Models\Query\Customer\CustomerSupply;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str as UniqueString;

/**
 * Customer Service Class that contains Customer BL
 */
class CustomerSupplyService
{

    private $uniqueStringId;

    private $idStringLength = 30;

    private $totalPageRecord = 10;

    public function __construct(UniqueString $uniqueStringId)
    {
        $this->uniqueStringId = UniqueString::random($this->idStringLength);
    }

    /**
     * Creates new CustomerSupply
     * @param $customerDetails array
     * @return CustomerSupply
     */
    public function createCustomerSupply(array $customerSupplyDetails)
    {   
        $supplyData['id'] = $this->uniqueStringId;
        $supplyData['customerId'] = $customerSupplyDetails['customerId'];
        $supplyData['supplyId'] = $customerSupplyDetails['supplyId'];
        $supplyData['quantity'] = $customerSupplyDetails['quantity'];

        $customerCollection = $this->collectCustomerSupplyDetails($supplyData);
        $customerSupply = $customerCollection->getCreateCustomerSupplyDetails($customerCollection);
        $newCustomerSupply = CustomerSupply::create($customerSupply);
        return $newCustomerSupply;
    }
    
    /**
     * Get a CustomerSupply
     * @param $CustomerSupplyId string
     */
    public function getCustomerSupply(string $customerSupplyId)
    {
        return CustomerSupply::getCustomerSupply($customerSupplyId);
    }

    /**
     * Updates existing CustomerSupply
     * @param $CustomerSupplyId string
     * @param $customerSupplyDetails array
     * @return CustomerSupply
     */
    public function updateCustomerSupply(string $customerSupplyId, array $customerSupplyDetails)
    {
        $customerSupplyCollection = $this->collectCustomerSupplyDetails($customerSupplyDetails);
        $customerSupplyData = $customerSupplyCollection->getUpdatecustomerSupplyDetails($customerSupplyCollection);
        $updatedCustomerSupply = CustomerSupply::updateCustomerSupply($customerSupplyId,  $customerSupplyData);
        return $updatedCustomerSupply->refresh();
    }


    /**
     * Lists all Supplies
     * @return CustomerSupply
     */
    public function listSupplies(string $customerId)
    {
        return CustomerSupply::where('customerId', '=', $customerId)
        ->with('supplies')
        ->with('customers')
        ->paginate(10);
    }


    /**
     * Stores CustomerSupply details into collection
     * @param $customerDetails array
     * @return CustomerSupplyCollection
     */
    private function collectCustomerSupplyDetails(array $customerDetails)
    {
        return app()->make(CustomerSupplyCollection::class, [
            'items' => $customerDetails
        ]);
    }
}
