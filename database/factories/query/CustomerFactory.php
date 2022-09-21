<?php

namespace Database\Factories\Query;

use App\Models\Query\Customer;  
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;  

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
	 public function definition()  
	 {
		 return [  
			'id' => $this->faker->unique()->randomDigitNotNull(),
			'customer' => $this->faker->word,  
			'points' => $this->faker->randomNumber(1),  
		 ];  
	 }
}