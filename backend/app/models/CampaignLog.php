<?php

	namespace App\Models;
	
	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;
	
	class CampaignLog extends Model 
	{
		use HasFactory;
		
		protected $fillable = [
			'campaign_id',
			'lead_id',
			'action',
			'logged_at',
		];
		
		protected $casts = [
			'logged_at' => 'datetime',
		];
		
		/* RELATIONSHIP  */
		
		/* Campaign this log belong to. */
		public function campaign()
		{
			return $this->belogsTo(Campaign::class);
		}
		
		/* Lead this log is tracking */
		public function lead()
		{
			return $this->belongTo(Lead::class);
		}
	}
	