<?php
	
	/* Database/seeders/CampaignLogSeeder.php */
	use Illuminate\Database\Seeder;
	use App\Models\CampaignLog;
	
	class CampaignLogSeeder extends Seeder 
	{
			public function run(): void 
			{
				CampaignLog::factory()->count(50)->create();
			}
	}
		