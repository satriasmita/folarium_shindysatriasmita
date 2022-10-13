<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{
    protected $table = 'kontrak';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kontrak_awal',
        'kontrak_akhir',
        'pegawai_id', 'id_jabatan', 'kontrak_status'
    ];
}
