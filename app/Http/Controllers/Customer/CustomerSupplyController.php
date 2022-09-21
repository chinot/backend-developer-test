<?php

namespace App\Http\Controllers\Customer;


use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerSupplyRequest;
use App\Services\Customer\CustomerSupplyService;
use App\Http\Resources\Customer\CustomerSupplyCollection;
use App\Http\Resources\Customer\CustomerSupplyResource;


use Exception;


class CustomerSupplyController extends Controller
{

    /* Instance of CustomerSupplyService 
    *  @var CustomerSupplyService
    */
    public $CustomerSupplyService;

    /**
     * CustomerSupplyController Constructor
     * @param $CustomerSupplyService CustomerSupplyService
     */
    public function __construct(CustomerSupplyService $CustomerSupplyService)
    {
        $this->CustomerSupplyService = $CustomerSupplyService;
    }

    /**
     * Lists all Supplies
     */
    public function show(string $customerId)
    {
        try {
            $suppliesList = $this->CustomerSupplyService->listSupplies($customerId);
            return new CustomerSupplyCollection($suppliesList);
        } catch(Exception $exception) {
            //TODO add custom exception 
            return $exception->getMessage();
        }
    }

    /**
     * Creates new CustomerSupply
     * @param $request CustomerSupplyRequest
     */
    public function store(CustomerSupplyRequest $customerSupplyRequest)
    {
        try {
            $data = $customerSupplyRequest->validated();
            $newCustomerSupply = $this->CustomerSupplyService->createCustomerSupply($data);
            return new CustomerSupplyResource($newCustomerSupply);
        } catch(Exception $exception) {
            //TODO add custom exception 
            return $exception->getMessage();
        }
    }

    /**
     * Update a CustomerSupply
     * @param customerRequest $customerRequest
     * @param $customerId string
     */
    public function update(CustomerSupplyRequest $customerSupplyRequest, string $customerSupplyId)
    {
        try {
            $data = $customerSupplyRequest->validated();
            $updatedCustomerSupply = $this->CustomerSupplyService->updateCustomerSupply($customerSupplyId, $data);

            return new CustomerSupplyResource($updatedCustomerSupply);
        } catch (Exception $exception) {
            //TODO add custom exception 
            return $exception->getMessage();
        }
    }
}