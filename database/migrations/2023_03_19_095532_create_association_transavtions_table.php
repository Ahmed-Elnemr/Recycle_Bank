<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociationTransavtionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('association_transavtions', function (Blueprint $table) {
            $table->id();
            //association_models
            $table->foreignId('association_models_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->integer('value')->default(0);
            $table->integer('currunt_month')->nullable();
            $table->integer('next_month')->nullable();
            $table->foreignId('wallet_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('wallet_transactions_id')->nullable()->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('association_transavtions');
    }
}
