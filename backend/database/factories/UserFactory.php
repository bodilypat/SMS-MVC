<?php

	namespace Database\Factories;
	
	use App\Model\User;
	use Illuminate\Database\Eloquent\Factories\Factory;
	use Illuminate\Support\Facades\Hash;
	use Illuminate\Support\Str;
	
	class UserFactory extends Factory 
	{
		protected $model = User::class;
		
		public function definition(): array 
		{
			return [
				'name' => $this->faker->name(),
				'email' => $this->faker-unique()->safeEmail(),
				'email_verified_at' => now(),
				'password' => hash::make('password'),
				'role' => $this->faker->randomElement($role),
				'phone' => $this->faker->Optional()->phoneNumber(),
				'job_title' => $this->faker->Optional()->jobTitle(),
				'avator' => $this->faker->Optional()->imageUrl(200, 200,'people', true, 'User'),
				'remember_token' => Str::random(10),
			];
		}
	}
	