<?php
	
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;
	
	return new class extends Migration {
		public function up(): void 
		{
			Schema::create('campaign_logs', fuction (Blueprint $table) {
				$table->id();
				
				/* RELATIONSHIP */
				$table->foreignId('campaign_id')->constrained()->cascadeOnDelete();
				$table->foreignId('lead-id')->nullable()->constrained()->nullOnDelete();
				
				/* ACTION TYPES */
				$table->enum('action', ['sent','opened','clicked','bounced']);
				$table->timestamp('logged_at')->useCurrent();
				
				$table->timestamps();
			});
		}
		
		public function down(): void 
		{
				Schema::dropIfExist('campaign_logs');
		}
	};
	
	
	