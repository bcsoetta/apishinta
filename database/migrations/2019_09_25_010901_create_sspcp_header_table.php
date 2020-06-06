<?php

use App\MigrationTraitDokumen;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSspcpHeaderTable extends Migration {
	use MigrationTraitDokumen;

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sspcp_header', function(Blueprint $table)
		{
			$table->increments('id');

			// DATA DOKUMEN
			$this->addDokumenColumns($table);
			$table->morphs('billable');
			$table->text('keterangan', 65535)->nullable();

			// $table->integer('cd_header_id')->unsigned()->index('fk_st_header_cd_id_cd_header_id');
			// $table->integer('no_dok')->unsigned();
			// $table->date('tgl_dok');
			// $table->integer('lokasi_id')->unsigned()->index('fk_st_header_lokasi_id_lokasi_id');
			// $table->decimal('total_fob', 18, 4)->nullable();
			// $table->decimal('total_freight', 18, 4)->nullable();
			// $table->decimal('total_insurance', 18, 4)->nullable();
			// $table->decimal('total_cif', 18, 4)->nullable();
			// $table->decimal('total_nilai_pabean', 18, 4)->nullable();
			// $table->decimal('pembebasan', 18, 4)->nullable()->comment('dalam USD');

			// DATA PEMBAYARAN
			$table->decimal('total_bm', 18, 4)->nullable();
			$table->decimal('total_ppn', 18, 4)->nullable();
			$table->decimal('total_ppnbm', 18, 4)->nullable();
			$table->decimal('total_pph', 18, 4)->nullable();
			$table->decimal('total_denda', 18, 4)->nullable();

			$table->string('kode_valuta', 8)->nullable();	// WTF IS THIS?
			// $table->string('pemilik_barang')->nullable();
			// $table->string('ground_handler')->nullable();
			// $table->integer('pejabat_id')->unsigned();
			$table->decimal('nilai_valuta', 18, 4)->nullable();	// WTF IS THIS?

			// DATA WAJIB BAYAR
			$table->string("nama_wajib_bayar")->nullable();
			$table->string("npwp_wajib_bayar")->nullable();
			$table->string("no_identitas_wajib_bayar")->nullable();
			$table->string("jenis_identitas_wajib_bayar")->nullable();
			$table->text("alamat_wajib_bayar");
			// $table->string("nama_pengangkut")->nullable();
			// $table->string("nama_eksportir")->nullable();

			// DATA PEJABAT
			$table->string("nama_pejabat");
			$table->string("nip_pejabat");

			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sspcp_header');
	}

}
