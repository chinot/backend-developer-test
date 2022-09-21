<?php
namespace App\Http\Controllers\Supply;

use App\Http\Controllers\Controller;
use App\Services\Supply\TradeSupplyService;

class SupplyTradeController extends Controller
{

    public function trade(TradeSupplyService $tradeService)
    {   
        try {
            $tradeService->tradeSupply();
            
            //return new SupplyResource($newSupply);
        } catch(Exception $exception) {
            //TODO add custom exception 
            return $exception->getMessage();
        }
    }

    
}