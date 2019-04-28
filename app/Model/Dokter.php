<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $fillable=['nama_dokter','alamat','nomor_telepon','spesialisasi'];
    protected $primaryKey="dokter_id";
    protected $table="dokters";
    public $timestamps=false;
}
