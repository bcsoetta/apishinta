<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('st_detail', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->integer('st_header_id')->unsigned();
			$table->integer('cd_detail_id')->unsigned();
			$table->decimal('fob', 18, 4)->nullable();
			$table->decimal('freight', 18, 4)->nullable();
			$table->decimal('insurance', 18, 4)->nullable();
			$table->decimal('cif', 18, 4)->nullable();
			$table->decimal('nilai_pabean', 18, 4)->nullable();
			$table->decimal('pembebasan', 18, 4)->nullable()->comment('dalam USD');
			$table->decimal('trf_bm', 8, 4)->nullable();
			$table->decimal('trf_ppn', 8, 4)->nullable();
			$table->decimal('trf_ppnbm', 8, 4)->nullable();
			$table->decimal('trf_pph', 8, 4)->nullable();
			$table->decimal('bm', 18, 4)->nullable();
			$table->decimal('ppn', 18, 4)->nullable();
			$table->decimal('ppnbm', 18, 4)->nullable();
			$table->decimal('pph', 18, 4)->nullable();
			$table->decimal('denda', 18, 4)->nullable();
			$table->text('keterangan', 65535)->nullable();
			$table->string('kode_valuta', 8)->nullable();
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
		Schema::drop('st_detail');
	}

}
