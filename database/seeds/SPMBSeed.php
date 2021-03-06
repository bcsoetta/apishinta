<?php

use Illuminate\Database\Seeder;

class SPMBSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $jumlah= 30;

        echo "generating about {$jumlah} SPMB(s)...\n";

        $a = 0;
        $created = 0;

        while($a++ < $jumlah){
            // grab random CD
            $cd = App\CD::inRandomOrder()->first();

            // test if it has one
            $spmb = $cd->spmb;

            // bail if one exists
            if ($spmb) {
                continue;
            } else {
                $created++;
                $spmb = new App\SPMB;
            }

            // associate with random lokasi
            $spmb->lokasi()->associate(App\Lokasi::inRandomOrder()->first());

            $spmb->no_dok = getSequence('SPMB/'.$spmb->lokasi->nama.'/SH', date('Y'));
            $spmb->tgl_dok = date('Y-m-d');
            // $spmb->lokasi_id = App\Lokasi::inRandomOrder()->first()->id;
            $spmb->total_fob = $cd->details()->sum('fob');
            $spmb->nilai_valuta = $faker->randomFloat(NULL,92.82, 14067.999);
            $spmb->kode_valuta = $faker->randomElement(['JPY', 'USD', 'KRW', 'GBP', 'INR']);
            $spmb->keterangan =  $faker->sentence(10);
            $spmb->maksud_pembawaan =  $faker->sentence(10);
            $spmb->no_tiket =  $faker->bothify('####??');
            $spmb->pemilik_barang =  $faker->name();
            $spmb->pejabat_id =  $faker->numberBetween(1,10);
            $spmb->total_brutto = 0;
            $spmb->total_netto = 0;
            
            $cd->spmb()->save($spmb);

            foreach ($cd->details as $cdd) {

                $det = new App\DetailSPMB([
                    'cd_detail_id'  => $cdd->id,
                    'fob'  => $cdd->fob,
                    'keterangan' => $faker->sentence(10),
                    'kode_valuta'  => $faker->randomElement(['JPY', 'USD', 'KRW', 'GBP', 'INR']),
                    'hs_code'  => $faker->numerify("########"),
                    'nilai_valuta' => $faker->randomFloat(NULL,92.82, 14067.999),
                    'brutto' => $faker->randomFloat(5, 500),
                    'netto' => $faker->randomFloat(5, 500),
                ]);

                // $cd->details()[$b]->save($det);
                
                $spmb->details()->save($det);
            }

            $spmb->total_brutto =   ceil($spmb->details()->sum('brutto'));
            $spmb->total_netto =   ceil($spmb->details()->sum('netto'));

            $spmb->push();

        }

        echo "SPMB data seeded with {$created} data.\n";
    }
}
