<?php

namespace App\Http\Controllers;

use App\Pegawai;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PegawaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $versis = Pegawai::select('*')->get();
        $versi = [];
        $no = 1;
        foreach ($versis as $row) {
            $versi[] = [
                'no' => $no++ . '.',
                'nip' => $row->peg_nik,
                'nama' => $row->peg_nama,
                'lahir' => $row->peg_tempatlahir . ' / ' . $row->peg_tanggallahir,
                'pddk' => $row->peg_pendidikan,
                'jk' => $row->peg_jk,
                'agama' => $row->peg_agama,
                'menu' => '<button type="button" data-id="' . $row->id . '" data-nama="' . $row->peg_nama . '" data-lahir="' . $row->peg_tempatlahir . '" rel="tooltip" title="" class="btn btn-primary btn-sm editPegawai" data-original-title="Edit"><i class="fa fa-pencil"></i> Edit</button>
                <button type="button" class="btn btn-danger btn-sm deletePegawai" data-id="' . $row->id . '" data-original-title="Delete" title="Delete"><i class="fa fa-trash-o"></i> Hapus</button>'
            ];
        }

        return json_encode($versi);
    }

    public function store(Request $request)
    {
        Pegawai::updateOrCreate(
            ['id' => $request->pegawai_id],
            ['peg_nik' => $request->nip, 'peg_nama' => $request->nama, 'peg_tempatlahir' => $request->tempat_lahir, 'peg_tanggallahir' => Carbon::parse($request->tanggal_lahir)->format('Y-m-d'), 'peg_jk' => $request->jk, 'peg_agama' => $request->agama, 'peg_pendidikan' => $request->pendidikan]
        );

        return response()->json(['success' => 'Customer saved successfully!']);
    }

    public function edit($id)
    {
        $pegawai = Pegawai::find($id);
        return response()->json($pegawai);
    }

    public function destroy($id)
    {
        Pegawai::find($id)->delete();

        return response()->json(['success' => 'Customer deleted!']);
    }

    public function pegawai()
    {
        return view('pegawai.index');
    }
}
