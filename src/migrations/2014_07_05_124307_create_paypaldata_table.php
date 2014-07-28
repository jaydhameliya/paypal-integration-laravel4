<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaypaldataTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('paypaldata', function(Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->text('inp_string');
            $table->integer('customer_id');
            $table->string('customer_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('paypaldata');
    }

}
