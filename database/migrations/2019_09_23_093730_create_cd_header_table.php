<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCdHeaderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cd_header', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('no_dok')->unsigned();
			$table->string('no_hp', 32)->default('');
			$table->date('tgl_dok');
			$table->string('npwp', 32)->default('');
			$table->integer('penumpang_id')->unsigned()->index('fk_cd_header_penumpang_id_penumpang_id');
			$table->string('nib', 32)->default('');
			$table->text('alamat', 65535);
			$table->integer('lokasi_id')->unsigned()->index('fk_cd_header_lokasi_id_lokasi_id');
			$table->date('tgl_kedatangan')->nullable();
			$table->string('no_flight', 64);
			$table->smallInteger('jml_anggota_keluarga')->unsigned()->default(0);
			$table->smallInteger('jml_bagasi_dibawa')->unsigned()->default(0);
			$table->smallInteger('jml_bagasi_tdk_dibawa')->unsigned()->default(0);
			$table->set('declare_flag',['KARANTINA','NARKOTIKA','UANG','BKC','KOMERSIL','IMPOR_UNTUK_DIPAKAI'])->default('');
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
		Schema::drop('cd_header');
	}

}