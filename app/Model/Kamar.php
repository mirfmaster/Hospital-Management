<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table="kamars";
    protected $fillable=['ruang_perawatan','kelas','nomor_kamar'];
    protected $primaryKey="kamar_id";

    public function dokter()
    {
        return $this->belongsToMany('App\Model\Dokter','rawat_inaps','dokter_id','dokter_id')
        ->withPivot(
            'no_rm',
            'nama_pasien',
            'dokter_id',
            'kamar_id',
            'usia',
            'tanggal_lahir',
            'jenis_kelamin',
            'tanggal_masuk',
            'tanggal_keluar',
            'lama_hari_rawat',
            'diagnosa_utama',
            'diagnosa_kedua',
            'nama_operasi_1',
            'nama_operasi_2',
            'tanggal_operasi',
            'status_keadaan_keluar',
            'status'
        )
        ->orderBy('status','asc');
    }
}
