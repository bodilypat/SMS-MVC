<?php

	namespace Database\Factories;
	
	use App\Models\Lead;
	use App\Models\User;
	use Illuminate\Database\Eloquent\Factories\Factory;
	
	class LeadFactory extends Factory
	{
		protected $model = Lead::class;
		
		public function definition(): array
		{
			return [
				'name' => $this->faker->name(),
				'email' => $this->faker->unique()->safeEmail(),
				'phone' => $this->faker->phoneNumber(),
				'source' => $this->faker->randomElement(['web', 'referral', 'ad', 'email campaign', 'social media'),
				'status' => $this->faker->ramElement(['new', 'contected', 'qualified', 'convered', 'lost']),
				'assigned_to' =>User::inRandomOrder()->first()?->id,
				'lead_source' => $this->faker->numberBetween(0, 100),
				'interest_level' => $this->faker->randomElement(['low', 'medium', 'high']),
				'notes' => $this->faker->optional()->sentence(),
			];
		}
	}
	