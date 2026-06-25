<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionsTable extends Migration
{
    public function up()
    {
        Schema::create('productions', function (Blueprint $table) {

            $table->id();

            $table->date('production_date');

            $table->string('product_line', 50);

            $table->unsignedInteger('produced_quantity');

            $table->unsignedInteger('defect_quantity');

            $table->timestamps();

            $table->index('production_date');

            $table->index('product_line');

        });
    }

    public function down()
    {
        Schema::dropIfExists('productions');
    }
}