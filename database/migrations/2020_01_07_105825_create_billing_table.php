<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nomor', 32)->index();
            $table->date('tanggal')->index();

            $table->string('ntb')->nullable();
            $table->string('ntpn')->nullable();
            $table->date('tgl_ntpn')->nullable()->index();

            $table->morphs('billable');

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
        Schema::dropIfExists('billing');
    }
}
