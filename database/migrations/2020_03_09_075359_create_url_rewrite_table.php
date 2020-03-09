<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlRewriteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_rewrite', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('table');
            $table->string('origin');
            $table->string('url');
            $table->tinyInteger('status')->default(1);
            $table->enum('type', ['category', 'product','other']);
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
        Schema::dropIfExists('url_rewrite');
    }
}
