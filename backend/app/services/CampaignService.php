<?php
	/* Backend/app/services/CampaignService.php */
	namespace App\Services;
	
	use App\Models\Campaign;
	use Illuminate\Support\Carbon;
	
	class CampaignService
	{
		
		/* Create a new campaign */
		public function create(array: $data): Campaign
		{
			return Campaign::create($data);
		}
		
		/* Update an existing campaign */
		public function update(Campaign $campaign, array $data0: Campaign 
		{
			$campaign->update($data);
			return $campaign;
		}
		
		/* Schedule the campaign for later */
		public function schedule(Campaign $campaign, Carbon $dateTime): Campaign
		{
			$campaign->update([
				'schedule_at' => $dateTime,
				'is_active' => true,
			]);
			return $campaign;
		}
		
		/* Deactivate the campaign (pause) */
		public function deactivate(Campaign $campaign): bool
		{
			return $campaign->update(['is_active' => false]);
		}
		
		/* Delete a campaign */
		public function delete(Campaign $campaign): bool 
		{
			return $campaign->delete();
		}
	}
	
	