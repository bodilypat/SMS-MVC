<?php

	/* Database/seeders/CampaignSeeder.php */
	use Illuminate\Database\Seeder;
	use App\Models\Deal;
	
	class CampaignSeeder extends Seeder 
	{
		public function run(): void 
		{	
			Campaign::factory()->count(10)->create();
		}
	}
	
	
			