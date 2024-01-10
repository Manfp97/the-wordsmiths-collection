<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleSecurableTable extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('role_securable', function (Blueprint $table) {
			$table->foreignId('role_id')->constrained();
			$table->foreignId('securable_id')->constrained();
			$table->primary(['role_id', 'securable_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('role_securable');
	}
};
