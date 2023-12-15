<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
	public function up()
	{
		Schema::create('subscriptions', function (Blueprint $table) {
			$table->id();
			$table->foreignId('subscription_plan_id')->constrained();
			$table->timestamp('start_date');
			$table->timestamp('end_date');
			$table->string('status');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('subscriptions');
	}
}
