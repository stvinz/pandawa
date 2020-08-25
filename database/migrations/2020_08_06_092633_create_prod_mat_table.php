<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdMatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod_mat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('products_id')->constrained();
            $table->foreignId('materials_id')->nullable()->constrained();
            $table->foreignId('brands_id')->nullable()->constrained();
            $table->string('extra')->nullable();
        });

        DB::statement('ALTER TABLE prod_mat ADD FULLTEXT fulltext_index (extra)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prod_mat');
    }
}
