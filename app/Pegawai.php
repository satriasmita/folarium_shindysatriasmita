<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'peg_nik',
        'peg_nama',
        'peg_tempatlahir',
        'peg_tanggallahir',
        'peg_jk',
        'peg_agama',
        'peg_pendidikan'
    ];
}
