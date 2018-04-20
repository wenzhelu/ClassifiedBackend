<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description', 1000);
            $table->integer('price');
            $table->integer('user_id');
            $table->string('category', 20);
            // 0 for selling, 1 for buying
            $table->integer('purpose');
            $table->string('photo_url')->default('');   // default empty string
            // 0 for active, 1 for banned, 2 for sold.
            $table->integer('status');
            $table->timestamps();
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
