<?php
namespace App\Transformers;

use App\CD;
use League\Fractal\TransformerAbstract;

class CDTransformer extends TransformerAbstract {
    // defaultly loaded relations
    protected $defaultIncludes = [
        'penumpang'
    ];

    // available relations, default relations not needed to apply
    protected $availableIncludes = [
        'penumpang',
        'details',
        'status',
        'pelabuhan_asal',
        'pelabuhan_tujuan'
    ];

    // basic transformation, without any sweetener
    public function transform(CD $cd) {
        $result = [
            'id'        => (int) $cd->id,
            'no_dok'    => (int) $cd->no_dok,
            'tgl_dok'   => (string) $cd->tgl_dok,
            'nomor_lengkap' => $cd->nomor_lengkap,
            'lokasi'    => $cd->lokasi->nama,
            'declare_flags' => $cd->flat_declare_flags,

            'penumpang_id'  => (int) $cd->penumpang_id,

            'npwp_nib'      => (string) ($cd->nib ? $cd->nib : $cd->npwp),
            'no_flight'     => (string) $cd->no_flight,
            'tgl_kedatangan'    => (string) $cd->tgl_kedatangan,

            'kd_pelabuhan_asal' => (string) $cd->kd_pelabuhan_asal,
            'kd_pelabuhan_tujuan' => (string) $cd->kd_pelabuhan_tujuan,

            'jumlah_detail' => $cd->details()->count(),

            'created_at'    => (string) $cd->created_at,
            'updated_at'    => (string) $cd->updated_at,

            'last_status'   => $cd->short_last_status,
            
            'is_locked'   => $cd->is_locked,

            'links' => $cd->links
                
        ];

        return $result;
    }

    // include penumpang?
    public function includePenumpang(CD $cd) {
        $penumpang = $cd->penumpang;
        // cmn ada satu penumpang, perlakukan sbg item tunggal
        return $this->item($penumpang, new PenumpangTransformer);
    }

    // include details
    public function includeDetails(CD $cd) {
        return $this->collection($cd->details, new DetailCDTransformer);
    }

    // include last status
    // public function includeLastStatus(CD $cd) {
    //     return $this->item($cd->last_status, new StatusTransformer);
    // }

     // include last status
    public function includeStatus(CD $cd) {
        $status = collect($cd->status()->latest()->get());
        return $this->collection($status, new StatusTransformer);
    }

    // include pelabuhan
    public function includePelabuhanAsal(CD $cd) {
        $pa = $cd->pelabuhanAsal;
        return $this->item($pa, new PelabuhanTransformer);
    }

    public function includePelabuhanTujuan(CD $cd) {
        $pt = $cd->pelabuhanTujuan;
        return $this->item($pt, new PelabuhanTransformer);
    }
}

?>