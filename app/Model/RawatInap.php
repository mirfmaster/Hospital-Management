<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class RawatInap extends Model
{
    protected $table="rawat_inaps";
    protected $fillable=[
        'no_rm',
        'nama_pasien',
        'dokter_id',
        'kamar_id',
        'usia',
        'jenis_kelamin',
        'lama_hari_rawat',
        'diagnosa_utama',
        'diagnosa_kedua',
        'nama_operasi_1',
        'nama_operasi_2',
        'status_keadaan_keluar',
        'tanggal_lahir',
        'tanggal_masuk',
        'tanggal_keluar',
        'tanggal_operasi',
    ];

    public $timestamps=false;

    public function dokter(){
        return $this->belongsTo('App\Model\Dokter','dokter_id','dokter_id');
    }

    public function kamar(){
        return $this->belongsTo('App\Model\Kamar','kamar_id','kamar_id');
    }

    public function diagnosa(){
        return $this->belongsTo('App\Model\Diagnose', 'diagnosa_utama');
    }

}
