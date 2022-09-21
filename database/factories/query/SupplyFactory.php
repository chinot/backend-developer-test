<?php

namespace Database\Factories\Query;

use App\Models\Query\Supply;  
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supply>
 */
class SupplyFactory extends Factory
{
    protected $model = Supply::class;  

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
	 public function definition()  
	 {
		 return [  
			'id' => $this->faker->unique()->randomDigitNotNull(),
			'supply' => $this->faker->word,  
			'points' => $this->faker->randomNumber(1),  
		 ];  
	 }
}