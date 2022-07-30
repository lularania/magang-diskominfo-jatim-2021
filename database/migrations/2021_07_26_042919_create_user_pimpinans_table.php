<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPimpinansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_pimpinans', function (Blueprint $table) {
            $table->id('id');
            // $table->foreignId('id_user')->nullable()->constrained('users');
            $table->foreignId('id_employee')->nullable()->constrained('employees');
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
        Schema::dropIfExists('user_pimpinans');
    }
}