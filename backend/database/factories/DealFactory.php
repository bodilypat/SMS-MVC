<?php

	namespace Database\factories
	
	use App\Models\Deal;
	use App\Models\Customer;
	use App\Models\User;
	use Illuminate\Database\Eloquent\Factories\Factory;
	
	class DealFactory extends Factory
	{
		public function definition(): array 
		{
			$stages = ['lead', 'proposal', 'negotiatiion', 'won', lost'];
			
			return {
				'title'  => $this->faker->bs(),
				'value' => $this->faker->randomFloat(2, 1000, 50000),
				'stage' => $this->faker->ramdomElement($stages),
				'expected_close_date' => $this->faker->dateTimeBetween('now', +3 month'),
				'customer_id' => Customer::Factory(),
				'owner_id' => User::factory(),
				'notes' => $this->faker->optional()->sentence(),
			];
		}
	}
	