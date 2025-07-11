<?php
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Facades\Schema:

	return new class extends Migration {
		public function up(): void 
		{
			Schema::create('leads', function (Blueprint $table) {
				$table->id();
				$table->string('name');
				$table->string('email')->unique();
				$table->string('phone')->nullable();
				$table->string('source')->nullable();
				$table->string('status')->default('new');
				$table->foreignId('assigned_to')
						->nullable()
						->constrained('users')
						->nullOnDelete();
				$table->timestamps();
			});
		}
		
		public function down(): void 
		{
			Schema::dropIfExists('leads');
		}
	};