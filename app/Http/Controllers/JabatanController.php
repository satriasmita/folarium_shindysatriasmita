<?php

namespace App\Http\Controllers;

use App\Jabatan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JabatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jabatans = Jabatan::select('*')->get();
        $versi = [];
        $no = 1;
        foreach ($jabatans as $row) {
            $versi[] = [
                'no' => $no++ . '.',
                'kode' => $row->kode_jabatan,
                'jabatan' => $row->jabatan_nama,
                'menu' => '<button type="button" data-id="' . $row->id . '" rel="tooltip" title="" class="btn btn-primary btn-sm editJabatan" data-original-title="Edit"><i class="fa fa-pencil"></i> Edit</button>
                <button type="button" class="btn btn-danger btn-sm deleteJabatan" data-id="' . $row->id . '" data-original-title="Delete" title="Delete"><i class="fa fa-trash-o"></i> Hapus</button>'
            ];
        }

        return json_encode($versi);
    }

    public function store(Request $request)
    {
        Jabatan::updateOrCreate(
            ['id' => $request->jabatan_id],
            ['kode_jabatan' => $request->kode, 'jabatan_nama' => $request->jabatan]
        );

        return response()->json(['success' => 'Jabatan berhasil disimpan!']);
    }

    public function edit($id)
    {
        $jabatan = Jabatan::where('id', $id)->first();
        return response()->json($jabatan);
    }

    public function destroy($id)
    {
        Jabatan::find($id)->delete();

        return response()->json(['success' => 'Jabatan berhasil dihapus!']);
    }

    public function jabatan()
    {
        return view('jabatan.index');
    }
}
