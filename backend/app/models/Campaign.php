<?php
	
	/* Backend/app/models/Campain.php */
	namespace App\Models;
	
	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;
	
	class Campaign extends Model
	{
		use HasFactory;
		
		protected $fillable  [
			'name',
			'description',
			'type',
			'scheduled',
			'is_active',
			'created_by',
		];
		
		public function create()
		{
			return $this->belogsTo(User::class, 'created_by');
		}
		
		public function logs()
		{
			return $this->hasMany(CampaignLog::class);
		}
	}
	
			