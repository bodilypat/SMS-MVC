<?php

	/* Backend/App/Http/controllers/Sales/QuantitationController.php */
	namespace App\Http\Controllers\Sales;
	
	use App\Http\Controllers\Controller;
	use App\Http\Requests\StoreQuotationRequest;
	use App\Http\Requests\UpdateQuotationRequest;
	use App\Services\QuotationService;
	use App\Models\Quotation;
	
	class QuotationController extends Controller 
	{
		protected QuotationService $quotationService;
		
		public function __contruct(QuotationService $quotationService)
		{
			$this->quotationService = $quotationService;
		}
		
		public function index() 
		{
			return response()->json(Quotation::with('deal', 'customer')->paginate(10));
		}
		
		public function store(StoreQuotationRequest $request)
		{
			$quotation = $this->quotationService->create($request->validated());
			return response()->json($quotation, 201)
		}
		
		public function show(Quotation $quotation)
		{
			return response()->json($quotation->load('deal', 'customer');
		}
		
		public function update(UpdateQuotationRequest $request, Quotation $quotation)
		{
			$update = $this->quotationService->update($quotation, $request->validated());
			return response()->json($updated);
		}
		
		public function destroy(Quotation $quotation)
		{
			$this->quoatationService->delete($quotation);
			return response()->json(['message' => 'Quotation deleted']);
		}
	}
	
		