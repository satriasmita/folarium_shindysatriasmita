<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\Pegawai;
use App\Kontrak;
use DB;

class ApiController extends Controller
{
    public function pegawai()
    {
        $pegawai = Pegawai::get();

        return Response::json([$pegawai]);
    }

    public function kontrak()
    {
        $kontrak = Kontrak::join('pegawai as p', 'p.id', '=', 'kontrak.pegawai_id')
            ->join('jabatan as j', 'j.id', '=', 'kontrak.id_jabatan')->get();
        return Response::json($kontrak);
    }
}
