<?php

	/* backend/database/migrations/create_campaign_leads_table.php */
	
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;
	
	return new class extends Migration {
		public function up(): void
		{
			Schema::create('campaign_leads', function(Blueprint $table) {
				$table->id();
				
				/* Foreign keys*/
				$table->foreignId('campaign_id')
				
					->constrained('campaigns')
					->cascadeOnDelete();
					
				$table->foreignId('lead_id')
					->constrained('leads')
					->cascadeOnDelete();
					
				/* Prevent duplicate */
				$table->unique(['campaign_id', 'lead_id']);
				
				$table->timestamps();
			});
		}
		public function down(): void 
		{
			Schema::dropIfExists('campaign_leads')
		}
	}
	