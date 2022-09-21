<?php

namespace App\Http\Controllers\Supply;


use App\Http\Controllers\Controller;
use App\Http\Requests\Supply\SupplyRequest;
use App\Services\Supply\SupplyService;
use App\Http\Resources\Supply\SupplyCollection;
use App\Http\Resources\Supply\SuppliesResource;
use App\Http\Resources\Supply\SupplyResource;


use Exception;


class SupplyController extends Controller
{

    /* Instance of SupplyService 
    *  @var SupplyService
    */
    public $SupplyService;

    /**
     * SupplyController Constructor
     * @param $SupplyService SupplyService
     */
    public function __construct(SupplyService $SupplyService)
    {
        $this->SupplyService = $SupplyService;
    }

    /**
     * Lists all Supplies
     */
    public function index()
    {
        try {
            $suppliesList = $this->SupplyService->listSupplies();
            return new SupplyCollection($suppliesList);
        } catch(Exception $exception) {
            //TODO add custom exception 
            return $exception->getMessage();
        }
    }

    /**
     * Creates new Supply
     * @param $request SupplyRequest
     */
    public function store(SupplyRequest $supplyRequest)
    {
        try {
            $data = $supplyRequest->validated();
            $newSupply = $this->SupplyService->createSupply($data);
            return new SupplyResource($newSupply);
        } catch(Exception $exception) {
            //TODO add custom exception 
            return $exception->getMessage();
        }
    }

    /**
     * Get a Supply
     * @param $supplyId string
     */
    public function show(string $supplyId)
    {
        try {
            $Supply = $this->SupplyService->getSupply($supplyId);
        
            return new SupplyResource($Supply);
        } catch(Exception $exception) {
            //TODO add custom exception 
            return $exception->getMessage();
        }
    }

    /**
     * Update a Supply
     * @param supplyRequest $supplyRequest
     * @param $supplyId string
     */
    public function update(supplyRequest $supplyRequest, string $supplyId)
    {
        try {
            $data = $supplyRequest->validated();
            $updatedSupply = $this->SupplyService->updateSupply($supplyId, $data);

            return new SupplyResource($updatedSupply);
        } catch (Exception $exception) {
            //TODO add custom exception 
            return $exception->getMessage();
        }
    }

    public function trade() {
        echo 1; exit;
    }
}