<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociationModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('association_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

            $table->integer('value')->default(500);
            $table->timestamp('approved_on')->nullable();

            $table->string('state')->default("pending");
            $table->integer('user_order')->default(10);

            $table->boolean('claimed')->default(false);
            $table->timestamp('claimed_date')->nullable();

            $table->boolean('finished')->default(false);

            $table->timestamp('finished_date')->nullable();

            $table->boolean('suspended')->default(false);

            $table->timestamp('due_date')->nullable();
            $table->timestamp('last_installment_date')->nullable();

            $table->integer('next_month')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('association_models');
    }
}
