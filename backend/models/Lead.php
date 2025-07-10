<?php

	/* Backend/models/Lead.php */
	namespace App\Models;
	
	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;
	
	class Lead extends Model 
	{
		use HasFactory;
		
		protected $fillable = [
			'name',
			'email',
			'phone',
			'source',
			'status',
			'assigned_to',
		];
		
		public function assignedUser()
		{
			return $this->belongsTo(User::class, 'assigned_to');
		}
		
		public function campainLogs()
		{
			return $this->hasMany(CampaignLog::class);
		}
	}
