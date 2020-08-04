<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebhookCallsTable extends Migration
{
    public function up()
    {
        Schema::create('webhook_calls', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->enum('type', ['initial', 'renewal_success', 'renewal_failure', 'cancel']);

            // TODO: use products table
            $table->string('product_id')->nullable();
//            $table->unsignedBigInteger('product_id');
//            $table->foreign('product_id')->references('id')->on('products');

            // TODO: use payment_providers table
            $table->string('provider');
//            $table->unsignedBigInteger('provider_id');
//            $table->foreign('provider_id')->references('id')->on('payment_providers');

            // TODO: use clients table
            $table->bigInteger('client_id');

            $table->text('relevant_data')->nullable();
            $table->text('payload')->nullable();
            $table->text('exception')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('webhook_calls');
    }
}
