<?php

	/* Database/seeders/LeadSeeder.php */
	use Illuminate\Database\Seeder;
	use App\Models\Lead;
	
	class LeadSeeder extends Seeder 
	{
		public function run(): void 
		{
			Lead::factory()->count(30)->create();
		}
	}
	
	