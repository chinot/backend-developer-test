<?php

namespace App\Http\Controllers\Customer;


use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerRequest;
use App\Services\Customer\CustomerService;
use App\Http\Resources\Customer\CustomerCollection;
use App\Http\Resources\Customer\CustomersResource;
use App\Http\Resources\Customer\CustomerResource;


use Exception;


class CustomerController extends Controller
{

    /* Instance of CustomerService 
    *  @var CustomerService
    */
    public $CustomerService;

    /**
     * CustomerController Constructor
     * @param $CustomerService CustomerService
     */
    public function __construct(CustomerService $CustomerService)
    {
        $this->CustomerService = $CustomerService;
    }

    /**
     * Lists all Supplies
     */
    public function index()
    {
        try {
            $suppliesList = $this->CustomerService->listSupplies();
            return new CustomerCollection($suppliesList);
        } catch(Exception $exception) {
            //TODO add custom exception 
            return $exception->getMessage();
        }
    }

    /**
     * Creates new Customer
     * @param $request CustomerRequest
     */
    public function store(CustomerRequest $customerRequest)
    {
        try {
            $data = $customerRequest->validated();
            $newCustomer = $this->CustomerService->createCustomer($data);
            return new CustomerResource($newCustomer);
        } catch(Exception $exception) {
            //TODO add custom exception 
            return $exception->getMessage();
        }
    }

    /**
     * Get a Customer
     * @param $customerId string
     */
    public function show(string $customerId)
    {
        try {
            $Customer = $this->CustomerService->getCustomer($customerId);
        
            return new CustomerResource($Customer);
        } catch(Exception $exception) {
            //TODO add custom exception 
            return $exception->getMessage();
        }
    }

    /**
     * Update a Customer
     * @param customerRequest $customerRequest
     * @param $customerId string
     */
    public function update(customerRequest $customerRequest, string $customerId)
    {
        try {
            $data = $customerRequest->validated();
            $updatedCustomer = $this->CustomerService->updateCustomer($customerId, $data);

            return new CustomerResource($updatedCustomer);
        } catch (Exception $exception) {
            //TODO add custom exception 
            return $exception->getMessage();
        }
    }
}