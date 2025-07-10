<?php

	/* Database/seeders/CustomerSeeder.php */
	use Illuminate\Database\Seeder;
	use App\Models\Customer;
	
	class CustomerSeeder extends Seeder
	{
		public function run(): void 
		{
			Customer::factory()->count(20)->create();
		}
	}
	