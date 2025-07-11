<?php

	namespace App\Models;
	
	use Illuminate\Contracts\Auth\MustVerifyEmail;
	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Foundation\Auth\User as Authenticatable;
	use Illuminate\Notifications\Notifiable;
	
	class User extends Authenticatable 
	{
		use HasFactory, Notifiable;
		
		protected $fileable = [
			'name',
			'email',
			'password',
			'role',
		];
		
		protected $hidden = [
			'password',
			'remeber_token'
		];
		
		protected $cats = [	
			'email_verified_at' => 'datetime',
			];
		
		/* RELATIONSHIP */
		
		/* Leads assigned to this user */
		public function assignedLeads() 
		{
			return $this->hasMany(Lead::class, 'assigned_to');
		}
		
		/* Deals owned by this user */
		public function deals()
		{
			return $this->hasMany(Deal::class, 'owner_id');
		}
		
		/* Campaigns created by this user  */
		public function campaigns()
		{
			return $this->hasMany(Campaign::class, 'created_by');
		}
		
		/* HEADER METHODS */
		public function isAdmin(): bool 
		{
			return $this->role === 'admin' 
		}
		
		public function isSales() 
		{
			return $this->role === 'sales';
		}
		
		public function isMarketing(): bool
		{
			return $this->role === 'marketing';
		}
	}
	}
	
	