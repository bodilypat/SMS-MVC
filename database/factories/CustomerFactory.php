<?php

	/* Database/factories/CustomerFactory.php */
	use App\Models\Customer;
	use Illuminate\Database\Eloquent\factories\Factory;
	
	class Customerfactory extends Factory 
	{
		protected $model = Customer::class;
		
		public function definition(): array
		{
			return [
				'company_name' => $this->faker->company(),
				'contact_name' => $this->faker->name(),
				'email' => $this->faker->unique()->companyEmail(),
				'phone' => $this->faker->phoneNumber(),
				'industry' => $this->faker->randomElement['Tech', 'Finance', 'Retail']),
				'address' => $this->faker->Address(),
			];
		}
	}
	