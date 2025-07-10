<?php

	/* Backend/app/models/Deal.php */
	namespace App\Models;
	
	use Illuminate\Database\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;
	
	class Deal extends Model
	{
		use HasFactory
		
		protected $fillable = [
			'title',
			'value',
			'stage',
			'expected_close_date',
			'customer_id',
			'owner_id',
		];
		
		public function customer() 
		{
			return $this->belongsTo(Customer::class);
		}
		
		public function owner()
		{	
			return $this->belongsTo(User::class,'owner_id');
		}
		
		public function quotatios()
		{
			return $this->hasMany(Quotation::class);
		}
	}
	