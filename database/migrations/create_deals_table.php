<?php
	
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;
	
	return new class extends Migration {
		public function up(): void 
		{
			Schema::create('deals', function (Blueprint $table) {
				$table->id();
				$table->string('title');
				$table->decimal('value', 10, 2)->default(0.00);
				$table->string('stage')->default('lead');
				$table->date('expected_close_date')->nullable();
				
				/* RELATIONSHIPS */
				$table->foreignId('customer_id')->constrained()->cascadeOnDelete();
				$table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
				
				$table->tiemstamps();
			});
		}
		
		public function down(): void
		{
			Schema:: dropIfExists('deals');
		}
	};
	