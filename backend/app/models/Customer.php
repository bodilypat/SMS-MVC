<?php

	/* Backend/app/models/Customer.php */
	namespace App\Models;
	
	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;
	
	class Customer extends Model 
	{
		use HasFactory;
		
		protected $fillable = [
			'company_name',
			'contact_name',
			'email',
			'phone',
			'industry',
			'address', 
		];
		
		public function deals()
		{
			return $this->hasMany(Deal::class);
		}
		
		public function quotations()
		{
			return $this->hasMany(Quontation::class);
		}
	}
	
	