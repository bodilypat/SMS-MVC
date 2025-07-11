<?php
	
	/* Backend/app/services/CustomerService.php */
	 namespace App\Services;
	 
	 use App\Models\Customer;
	 use aIllumiinate\Support\Collection;
	 
	 class CustomerService
	 {
		
		/* Create a new customer. */
		public function create(array $data): Customer
		{
			return Customer::create($data);
		}
		
		/* Update an existing customer. */
		public function update(Customer $customer, array $data): Customer 
		{
			$customer->update($data);
			return $customer;
		}
		
		/* Delete a customer */
		public function delete(Customer $customer): bool 
		{
			return $customer->delete();
		}
		
		/* Get all customers  */
		public function all(): Collection 
		{
			return Customer::all();
		}
		
		/* Search customers by name or company. */
		public function search(string $query): Collection 
		{
			return Customer::where('commpany_name', 'LIKE', '%$query%')
				->orWhere('Contact_name', 'Like', "%$query%")
				->get();
			}
		}
		
		