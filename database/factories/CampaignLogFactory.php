<?php

	/* Database/factories/CampainLogFactory.php */
	use App\Models\CampaignLog;
	use Illuminate\Database\Eloquent\Factories\Factory;
	
	class CampaignLogFactory extends Factory 
	{
		protected $model = CampaignLog::class;
		
		public function defintion(): array 
		{
			return [
				'campaign_id' => \App\Models\Campaign::factory(),
				'lead_id' => \App\Models\Lead::Factory(),
				'action' => $this->faker->randomElement(['sent', 'opened', 'clicked', 'bounded']),
				'logged_at' => $this->faker->dateTimeBetween('-7 days', 'now'),
			];
		}
	}
	