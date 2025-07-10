<?php

	/* Database/factories/CampaignFactory.php */
	use App\Models\Campaign;
	use Illuminate\Database\Eloquent\Factories\Factory;
	
	class CampaignFactory extends Factory
	{
		protected $model = Campaign::class;
		
		public function definition(): array 
		{
			return [ 
				'name' => $this->faker->catchPhrase(),
				'description' => $this->faker->paragraph(),
				'type' => $this->randomEloquent(['email', 'sm', social']),
				'scheduled_at' => $this->faker->optional()->dateTimeBetween('new', '+1 week'),
				'is_active' => $this->faker->boolean(80),
				'created_by' => \App\Models\User::factory(),
			];
		}
	}
	
	
