<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStHeaderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('st_header', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->integer('no_dok')->unsigned();
			$table->date('tgl_dok');
			$table->decimal('total_fob', 18, 4)->nullable();
			$table->decimal('total_freight', 18, 4)->nullable();
			$table->decimal('total_insurance', 18, 4)->nullable();
			$table->decimal('total_cif', 18, 4)->nullable();
			$table->decimal('total_nilai_pabean', 18, 4)->nullable();
			$table->decimal('pembebasan', 18, 4)->nullable()->comment('dalam USD');
			$table->decimal('total_bm', 18, 4)->nullable();
			$table->decimal('total_ppn', 18, 4)->nullable();
			$table->decimal('total_ppnbm', 18, 4)->nullable();
			$table->decimal('total_pph', 18, 4)->nullable();
			$table->decimal('total_denda', 18, 4)->nullable();
			$table->text('keterangan', 65535)->nullable();
			$table->string('kode_valuta', 8)->nullable();
			$table->string('pemilik_barang')->nullable();
			$table->integer('pejabat_id')->unsigned();
			$table->decimal('nilai_valuta', 18, 4)->nullable();
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
		Schema::drop('st_header');
	}

}
