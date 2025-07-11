<?php

	/* Backend/database/migrations/create_opportunities_table.php  */
	
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;
	
	return new class extends Migration {
		public function up(): void 
		{
			Schema::create('opportunities', function (Blueprint $table) {
				$table->id();
				
				$table->string('title');
				$table->text('description')->nullable();
				$table->decimal('value', 10, 2)->default(0.00);
				$table->enum('stage', [
					'prospecting',
					'proposal', 
					'negotiation',
					'closed-won',
					'close-lost'
					])->default('prospecting');
				$table->date('expected_close')->nullable();
				
				$table->foreignId('lead_id')
					->constrained('leads')
					->cascadeOnDelete();
					
				$table->foreignId('user_id')
					->constrained('users')
					->cascadeOnDelete();
				
				$table->timestamps();
			});
		}
		
		public function down(): void 
		{
			Schema::dropIfExists('opportunities');
			
		}
	};
	
	