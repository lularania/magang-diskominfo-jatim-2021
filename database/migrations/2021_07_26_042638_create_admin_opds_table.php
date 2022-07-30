<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminOpdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_opds', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_user')->nullable()->constrained('users');
            $table->string('nama');
            $table->string('instansi');
            $table->foreignId('created_by')->nullable()->constrained('administrators');
            $table->foreignId('updated_by')->nullable()->constrained('administrators');
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
        Schema::dropIfExists('admin_opds');
    }
}