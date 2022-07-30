<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonans', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('id_adminOPD')->nullable()->constrained('admin_opds');
            $table->foreignId('id_kategori')->nullable()->constrained('kategori_permohonans');
            $table->foreignId('id_status')->nullable()->constrained('statuses');
            $table->string('instansi');
            $table->string('judul');
            $table->string('deskripsi')->nullable();
            // $table->string('alasan')->nullable();
            $table->string('berkas')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('employees');
            $table->foreignId('updated_by')->nullable()->constrained('employees');
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
        Schema::dropIfExists('permohonans');
    }
}