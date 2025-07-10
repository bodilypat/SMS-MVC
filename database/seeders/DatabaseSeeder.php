<?php
	
	/* Database/seeders/DatabaseSeeder.php */
	use Illuminate\Database\Seeder;
	
	class DatabaseSeeder extends Seeder 
	{
		public function run(): void
		{
			$this->call([
				LeadSeeder::class,
				CustomerSeeder::class,
				DealSeeder::class,
				CampainSeeder::class,
				CampainLogSeeder::class,
			]);
		}
	}
	