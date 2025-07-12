<?php

	namespace  Database\Factories;
	
	use Illuminat\Database\Eloquent\Factories\Factory;
	use Illuminate\Support\Str;
	
	class CampaignFactory extends Factor
	{
		public function definitions(): array 
		{
			$startDate = $this->facker->dateTimeBetween('-2 month', '+1 week');
			$endDate = $this->faker->dateTimeBetween($startDate, '+ month');
			$types = ['email', 'sms', 'social', ' ads'];
			return [
				'name' => $this->faker->catchPhrase(),
				'slug' => Str::slug($this->faker->unique()->catchPhrase(),
				'type' => $this->faker->randomElement($types),
				'start_date' => $startDate,
				'end_date' => $endDate,
				'bugget' => $this->faker->randomFloat(2, 100, 1000),
				'target_audience' => $this->faker->randomElement([
					'new leads', 'existing customers', 'hgh-value clients'
				]),
				'goal' => $this->faker-randomElement(['draf', 'scheduled', 'customer', 'retention'
					]),
				'status' => $this->faker->randomElement(['draft', 'scheduled', 'active', 'completed']),
				'click_through_rate' => $this->facker->randomFloat(2, 0.1, 15.0),
				'conversion_rate' => $this->faker-randomFloat(2, 0.1, 10.0),
				'notes' => $this->faker->sentence(),
			];
		}
	}
	
				