<?php

namespace App\Services\Supply;

use App\Models\Collections\Supply\SupplyCollection;
use App\Models\Query\Supply\Supply;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str as UniqueString;

/**
 * Supply Service Class that contains Supply BL
 */
class SupplyService
{

    private $uniqueStringId;

    private $idStringLength = 30;

    private $totalPageRecord = 10;

    public function __construct(UniqueString $uniqueStringId)
    {
        $this->uniqueStringId = UniqueString::random($this->idStringLength);
    }

    /**
     * Creates new Supply
     * @param $supplyDetails array
     * @return Supply
     */
    public function createSupply(array $supplyDetails)
    {
        $supplyValues = $this->setCreateSupplyDefaultValues($supplyDetails);
        $supplyCollection = $this->collectsupplyDetails($supplyValues);

        $newSupply = Supply::create($supplyCollection->getCreatesupplyDetails());
        return $newSupply;
    }

    /**
     * Get a Supply
     * @param $SupplyId string
     */
    public function getSupply(string $SupplyId)
    {
        return Supply::getSupply($SupplyId);
    }

    /**
     * Updates existing Supply
     * @param $SupplyId string
     * @param $supplyDetails array
     * @return Supply
     */
    public function updateSupply(string $SupplyId, array $supplyDetails)
    {
        $SupplyCollection = $this->collectsupplyDetails($supplyDetails);
        $updatedSupply = Supply::updateSupply($SupplyId, $SupplyCollection->getUpdatesupplyDetails());
        return $updatedSupply->refresh();
    }

    /**
     * Lists all Supplies
     * @return Supply
     */
    public function listSupplies()
    {
        return Supply::paginate($this->totalPageRecord);
    }

    /**
     * Sets Supply default values 
     * @param $supplyDetails array
     * @return array
     * @todo values for these fields will come from different modules
     */
    private function setCreateSupplyDefaultValues(array $supplyDetails)
    {
        $supplyDetails['id'] = $this->uniqueStringId;
        $supplyDetails['supply'] = $supplyDetails['supply'];
        $supplyDetails['points'] = $supplyDetails['points'];
        return $supplyDetails;
    }

    /**
     * Stores Supply details into collection
     * @param $supplyDetails array
     * @return SupplyCollection
     */
    private function collectsupplyDetails(array $supplyDetails)
    {
        return app()->make(SupplyCollection::class, [
            'items' => $supplyDetails
        ]);
    }
}
