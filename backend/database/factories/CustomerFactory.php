<?php

	namespace Database\Factories;
	
	use App\Models\Customer;
	use Illuminate\Database\Eloquent\Factories\Factory;
	
	class CustomerFactory extends Factory
	{
		protected $model = Customer::class;
		
		public function definition(): array 
		{
			return [ 
				'campany_name' => $this->faker->company(),
				'contact_name' => $this->faker->name(),
				'email' => $this->faker->unique()->companyEmail(),
				'phone' => $this->faker->phoneNumber(),
				'industry' => $this->faker->randomElement(['Tech', 'Finance', 'Retail', 'Healthcare', 'Education']),
				'website' => $this->faker->url(),
				'address' => $this->faker->address(),
				'city' => $this->faker->city(),
				'state' => $this->faker->state(),
				'country' => $this->faker->country(),
				'postal_code' => $this->faker->postcode(),
				'account_status' => $this->faker->randomElement(['active', 'inactive', 'prospect']),
				'notes' => $this->faker->optional()->sentence(),
			];
		}
	}
	
