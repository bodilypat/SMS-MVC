<?php
	
	/* Database/factoreis/DealFactory.php */
	use App\Models\Deal;
	use Illuminate\Database\Eloquent\Factories\Factory;
	
	class DealFactory extends Factory
	{
		protected $model = Deal::class;
		
		public function definition(): array 
		{
			return [
				'title'  => $this->faker->bs(),
				'value' => $this->faker->randomElement['lead', 'propersl', 'negotiation', 'lost']),
				'stage' => $this->faker->dateTimeBetween('new', '+3 months'),
				'customer_id' => \App\Models\Customer::factory(),
				'owner_id' => \App\Models\User::factory(),
			];
		}
	}
	