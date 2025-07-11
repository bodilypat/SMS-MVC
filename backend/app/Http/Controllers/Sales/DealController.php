<?php
	
	/* Backend/App/Http/Controllers/Sales/DealController.php */
	namespace App\Http\Controllers\Sales;
	
	use App\Http\Controllers\Controller;
	use App\Http\Requests\StoreDealRequest;
	use App\Http\Requests\UpdateDealRequest;
	use App\Services\DealService;
	use App\Models\Deal;
	
	class DealController extends Controllers\Controller
	{
		protected DealService $dealService;
		
		public function __contruct(DealService $dealService) 
		{
			$this->dealService = $dealService;
		}
		
		public function index()
		{
			return response()->json(Deal::with('customer', 'owner')->paginate(10);
		}
		
		public function store(StoreDealRequest $request) 
		{
			$deal = $this->dealService->create($request->validated());
			return response()->json($deal, 201);
		}
		
		public function show(Deal $deal)
		{
			return response()->json($deal->load('customer', 'owner'))
		}
		
		public function destroy(Deal $deal) 
		{
			$this->dealService->delete($deal);
			return response()->json(['message' => 'Deal deleted']);
		}
	}
