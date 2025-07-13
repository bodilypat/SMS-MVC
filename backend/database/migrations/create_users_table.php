<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;
	
	return new class extends Migration {
		public function up(): void
		{
			Schema::create('users', function (Blueprint $table) {
				$table->id();
				$table->string('name');
				$table->string('email')->unique();
				$table->timestamp('email_verified_at')->nullable();
				$table->string('password');
				$table->rememberToken();
				
				/* CUSTOM FIELD FOR USER TYPE */
				$table->enum('role', ['admin','sales','marketing'])->default('sales');
				
				/* Optional Profile Info */
				$table->string('phone')->nullable();
				$table->string('job_title')->nullable();
				$table->string('avator')->nullable();
				
				/* Token & Timestamps */
				$table->rememberToken();
				$table->timestamps();
			});
		}
		
		public function down(): void 
		{
				schema::dropIfExist('users');
		}
	};
	