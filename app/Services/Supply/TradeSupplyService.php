<?php

namespace App\Services\Supply;

use App\Models\Query\Supply\Supply;
use App\Models\Query\Customer\CustomerSupply;
use Illuminate\Http\Request;

/**
 * Supply Service Class that contains Supply BL
 */
class TradeSupplyService
{
    public $targetTradeSupply;

    public $supplyForTrade;

    public $totalSupplyToTrade;

    //todo add request validator
    public function __construct(Request $request) 
    {
        $traderData = $request->input();
        $this->totalSupplyToTrade = $traderData['totalSupplyToTrade'];
        $this->targetTradeSupply = CustomerSupply::where('id', '=', $traderData['traderSupplyId'])->firstOrFail();
        $this->supplyForTrade = CustomerSupply::where('id', '=', $traderData['buyerSupplyId'])->firstOrFail();
    }

    public function tradeSupply() 
    {
        $this->canTrade();
        return $this->trade();
    }

    public function canTrade() 
    {
        // check if user can trade user status is 1 , 0 not allowed
        // todo terminate process and throw exeption error

        return true;
    }

     public function trade() 
    {
        // TODO move computation to another class
        $totalPointsToTrade = $this->totalSupplyToTrade * $this->supplyForTrade->supplies->points;
        $totalPointsToBeTrade = $this->targetTradeSupply->supplies->points * $this->targetTradeSupply->quantity;
        
        $this->hasEnoughPointsToTrade($totalPointsToTrade,$totalPointsToBeTrade);

        $newTraderQuantity = $this->supplyForTrade->quantity - $this->totalSupplyToTrade;
        $newTradedQuantity = ($totalPointsToBeTrade  +  $totalPointsToTrade) / $this->targetTradeSupply->supplies->points; 

        $this->supplyForTrade->quantity = $newTraderQuantity;
        $this->supplyForTrade->save();
    
        $this->targetTradeSupply->quantity =  $newTradedQuantity;
        $this->supplyForTrade->save();
     
        // check if user can trade
        // todo terminate process and throw exeption error
        return $this->supplyForTrade;
    }


    public function hasEnoughPointsToTrade($totalPointsToTrade, $totalPointsToBeTrade) 
    {
        //add condition to method for future rules[
        if ($totalPointsToTrade <=  $totalPointsToBeTrade) {
            return true;
        }

        // throw error exeption
    }

    public function hasEnoughPointsToBeTrade() 
    {
        // check if user can trade
        // todo terminate process and throw exeption error

        return true;
    }
}
