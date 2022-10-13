<?php

namespace App\Http\Controllers;

use App\Jabatan;
use App\Kontrak;
use App\Pegawai;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KontrakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $versis = Kontrak::join('pegawai as p', 'p.id', '=', 'kontrak.pegawai_id')
            ->join('jabatan as j', 'j.id', '=', 'kontrak.id_jabatan')
            ->select('j.jabatan_nama', 'p.peg_nik', 'p.peg_nama', 'kontrak.*')->get();
        $versi = [];
        $no = 1;
        foreach ($versis as $row) {
            $versi[] = [
                'no' => $no++ . '.',
                'kode' => $row->peg_nik,
                'nama' => $row->peg_nama,
                'jabatan' => $row->jabatan_nama,
                'waktu' => $row->kontrak_awal . ' s/d ' . $row->kontrak_akhir,
                'status' => $row->kontrak_status,
                'menu' => '<button type="button" data-id="' . $row->id . '" rel="tooltip" title="" class="btn btn-primary btn-sm editKontrak" data-original-title="Edit"><i class="fa fa-pencil"></i> Edit</button>
                <button type="button" class="btn btn-danger btn-sm deleteKontrak" data-id="' . $row->id . '" data-original-title="Delete" title="Delete"><i class="fa fa-trash-o"></i> Hapus</button>'
            ];
        }

        return json_encode($versi);
    }

    public function store(Request $request)
    {
        Kontrak::updateOrCreate(
            ['id' => $request->kontrak_id],
            ['kontrak_awal' => Carbon::parse($request->awal)->format('Y-m-d'), 'kontrak_akhir' => Carbon::parse($request->akhir)->format('Y-m-d'), 'pegawai_id' => $request->pegawai, 'id_jabatan' => $request->jabatan, 'kontrak_status' => $request->status]
        );

        return response()->json(['success' => 'Kontrak berhasil disimpan!']);
    }

    public function edit($id)
    {
        $kontrak = Kontrak::find($id);
        return response()->json($kontrak);
    }

    public function destroy($id)
    {
        Kontrak::find($id)->delete();

        return response()->json(['success' => 'Data Kontrak berhasil dihapus!']);
    }

    public function kontrak()
    {
        $pegawai = Pegawai::select('id', 'peg_nama')->get();
        $jabatan = Jabatan::select('id', 'jabatan_nama')->get();
        return view('kontrak.index', compact('pegawai', 'jabatan'));
    }
}
