<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMytask extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mytask', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(true);
            $table->string('remark')->nullable(true);
            $table->string('parentid')->nullable(true);
            $table->string('txid')->nullable(true);
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
        Schema::dropIfExists('mytask');
    }
}
