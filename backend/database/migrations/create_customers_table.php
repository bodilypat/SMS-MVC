<?php

	/* Backend/database/migrations/create_customers_table.php */
	
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;
	
	return new class extends Migration {
		public function up(): void 
		{
			Schema::create('customers', function (Blueprint $table) {
				$table->id();
				$table->string('compay_name');
				$table->string('contact_name');
				$table->string('email')->unique();
				$table->string('phone')->nullable();
				$table->string('industry')->nullable();
				$table->string('address')->nullable();
				$table->timestamps();
			});
		}
		
		public function down(): void 
		{
			Schema::dropIfExists('customers');
		}
	};
	
	