<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableServicePage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicepage', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category');
            $table->string('subcategory');
            $table->string('content')->unique();
            $table->longText('description');
            $table->string('phonenumber');
            $table->longText('whatsapp');
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
        Schema::dropIfExists('table_service_page');
    }
}
