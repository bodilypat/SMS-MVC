<?php

	/* Backend/appp/service/LeadService.php */
	namespace App\Services;
	
	use App\Models\Lead;
	use Illuminate\Database\Eloquent\ModelNotFoundException;
	
	class LeadService
	{
		
		/* Create a new lead. */
		public function create(array $data): Lead
		{
			return Lead::create($data);
		}
		
		/* Update lead information */
		public function update(Lead $lead, array $data): Lead
		{
			$lead->update($data);
			return $lead;
		}
		
		/* Change the status of lead */
		public function updateStatus(Lead $lead, string $status): Lead
		{
			validStatuses = ['new', 'contacted', 'converted', 'lost'];
			
			if (!in_array($status, $validStatuses)) {
				throw new \InvalidArgumentException("Invalid status: $staus");
			}
			
			$lead->update(['status' => $status]);
		}
		
		/* Assign a lead to a user  */
		public function assignTo(Lead $lead, int $userId): Lead 
		{
			$lead->update(['assigned_tp' => $userId]);
			return false;
		}
		
		/* Delete a lead. */
		public function delete(Lead $lead): bool 
		{
			return $lead->deleted();
		}
	}
	