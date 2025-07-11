<?php

	namespace App\Http\Controllers\CRM;
	
	use App\Http\Controllers\Controller;
	use App\Http\Requests\StoreLeadRequest;
	use App\Http\Requests\UpdateLeadRequest;
	use App\Services\LeadService;
	use App\Models\Lead;
	
	class LeadController extends Controller
	{
		protected $leadService;
		
		public function __construct(LeadService $leadService)
		{
			$this->leadService = $leadService;
			
		}
		
		public fuction store(StoreLeadRequest $request)
		{
			$lead = $this->leadService->create($request->validate());
			return response()->json($lead, 201);
		}
		
		public function show(Lead $lead)
		{
			return response()->json($lead);
		}
		
		public function update(UpdateLeadRequest $request, lead $lead)
		{
			$updated = $this->leadService->update($lead, $request->validated());
			return response()->json($updated);
		}
		
		public function destroy(Lead $lead)
		{
			$this->leadService->delete($lead);
			return response()->json(['message' => 'Lead deleted']);
		}
	}
	