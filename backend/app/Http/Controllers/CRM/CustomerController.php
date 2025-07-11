<?php
	
	/* Backend/app/Http/Controllers/CRM/CustomerController.php */
	namespace App\Http\Controllers\CRM;
	
	use App\Http\Controllers\Controller;
	use App\Http\Requests\StoreCustomerRequest;
	use App\Http\Requests\UpdateCustomerRequest;
	use App\Services\CustomerService;
	use App\Models\Customer;
	
	class CustomerController extends Controllers
	{
		protected $customerService;
		
		public function __construct(CustomerService $customerService)
		{
			$this->customerService = $customerService;
		}
		
		public function index() 
		{
			$customers = Customer::latest()->paginate(10);
			return response()->json($customers);
		}
		
		public function store(storeCustomerRequest $request)
		{
			$customer = $this->customerService->create($request->validate());
			return response()->json($customer, 201);
		}
		
		public function show(Customer $customer) 
		{
			return response()->json($customer);
		}
		
		public function update(UpdateCustomerRequest $request, Customer $customer)
		{
			$updated = $this->customerService->update($customer, $request->validated());
			return response()->json($updated);
		}
		
		public function destroy(Customer $customer)
		{
			$this->customerService->delete($customer);
			return response()->json(['message' => 'Customer deleted']);
		}
	}
	