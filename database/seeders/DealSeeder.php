<?php
	
	/* Database/seeders/DealSeeder.php */
	use Illuminate\Database\Seeder;
	use App\Models\Deal;
	
	class DealSeeder extends Seeder 
	{
		public function run(): void 
		{
			Deal::factory()->count(15)->create();
		}
	}
	