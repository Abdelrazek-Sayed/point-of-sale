<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('product_translations', function (Blueprint $table) {
			$table->id();
			$table->string('locale')->index();
			$table->string('name');
			$table->longText('description');
			$table->unique(['product_id', 'locale']);
			$table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('product_translations');
	}
};
