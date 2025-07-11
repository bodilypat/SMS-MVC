<?php

	/* Backend/app/models/Quotation.pphp */
	namespace App\Models;
	
	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;
	
	class Quotation extends Model 
	{
		use HasFactory;
		
		protected $fillable = [
			'deal_id',
			'customer_id',
			'quote_number',
			'amount',
			'status',
			'expires_at',
		];
	
		public function deal()
		{
			return $this->belongsTo(Deal::class);
		}
		
		public function customer() 
		{
			return $this->belongsTo(Customer::class);
		}
	}
	