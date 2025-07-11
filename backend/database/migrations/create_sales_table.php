<?php

	/* Backend/database/migrations/crete_sales_table.php */
	
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\support\Facades\Schema;
	
	return new class extends Migration {
		public function up(): void 
		{
			Schema::create('sales', function (Blueprint $table) {
				$table->id();
			
				$table->foreignId('opportunity_id')
					->constrained()
					->cascadeDelete();
			
				$table->foreignId('customer_id')
					->constrained()
					->cascadeDelete();
				
				$table->foreignId('user_id')
					->constrained('users')
					->cascadeDelete();
				
				$table->decimal('amount', 10, 2)->default(0.00);
				$table->date('closed_at')->nullable();
				$table->string('reference')->nullable();
				$table->text('notes')->nullable();
			
				$table->timestamps();
			});
		}
		
		public function down(): void 
		{
			Schema::dropIfExists('sales');
		}
	}
	
	
	