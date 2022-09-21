<?php

namespace Tests\Feature\Api;  
  
use Tests\TestCase;
use App\Models\Query\Supply;

class SuppliesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
 		$supply = Supply::factory()->create();
		
		$response = $this->getJson(route('api.supplies.index'));

        $response->assertOk(); 
		
		// Add the assertion that will prove that we receive what we need 
		// from the response.
		$response->assertJson([
			'data' => [
				[
					'id' => $supply->id,
					'type' => $supply->type,  
					'price' => $supply->price,  
					'description' => $supply->description,
				]
			]
		]);
    }
}
