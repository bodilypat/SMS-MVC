<?php

	/* database/factories/LeadFactories.php  */
	
	use App\Models\Lead;
	use Illuminate\Database\Eloquent\Factories\Factory;
	
	class LeadFactory extends Factory
	{
		protected $model = Lead::class;
		
		public function definition(): array
		{
			return [
				'name' => $this->faker->name(),
				'email' => $this->faker->unique()->saleEmail(),
				'phone' => $this->faker->phoneNumber(),
				'source' => $this->faker->randomElement(['web', 'referral', 'ad']),
				'status' => $this->faker->randomElement(['new', 'contacted', 'converted', 'lost']),
				'assigned_to' => null,
			];
		}
	}
	