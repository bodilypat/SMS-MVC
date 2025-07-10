<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;
	
	return new class extends Migration {
		public function up(): void
		{
			Schema::create('campaigns', function (Blueprint $table) {
				$table->id();
				$table->String('name');
				$table->text('description')->nullable();
				$table->enum('type', ['email','sms','social'])->default('email');
				$table->timestamp('scheduled_at')->nullable();
				$table->boolean('is_active')->default(true);
			
				/* RELATIONSHIP */
				$table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
				
				$table->timestamp();
			});
		}
		
		public function down(): void 
		{
			Schema::dropIfExists('campaigns');
		}
	};
	
	
	