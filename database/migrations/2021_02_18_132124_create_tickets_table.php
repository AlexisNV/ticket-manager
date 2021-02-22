<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->string('uid');
            $table->primary('uid');
            $table->string('title');
            $table->string('category');
            $table->enum('priority', ['LOW', 'MEDIUM', 'HIGH']);
            $table->string('description', 4000);
            $table->enum('status', ['OPEN', 'CLOSE'])->default('OPEN');
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
        Schema::dropIfExists('tickets');
    }
}
