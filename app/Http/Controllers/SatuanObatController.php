<?php

namespace App\Http\Controllers;

use App\Models\SatuanObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SatuanObatController extends Controller
{
    public function index()
    {
        $findAllSatuan = SatuanObat::all();
        $data = [
            'satuan' => $findAllSatuan
        ];
        return view('modules.satuan.index', $data);
    }

    public function create()
    {
        return view('modules.satuan.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'satuan' => 'required'
        ];
        $message = [
            'required' => ':attribute Tidak Boleh Kosong',
        ];
        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            return redirect()
                ->route('satuan.create')
                ->withErrors($validation)
                ->withInput();
        }

        $satuan = new SatuanObat;
        $satuan->satuan = $request->satuan;
        $satuan->save();

        return redirect()
            ->route('satuan.create')
            ->with('success', true);
    }

    public function edit($id)
    {
        $findSatuanById = SatuanObat::find($id);
        $data = [
            'satuan' => $findSatuanById
        ];
        return view('modules.satuan.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $findSatuanById = SatuanObat::find($id);
        $findSatuanById->satuan = $request->satuan;
        $findSatuanById->save();
        return redirect()
            ->route('satuan.edit', ["id_satuan" => $findSatuanById->id_satuan])
            ->with('success', true);
    }

    public function destroy($id)
    {
        $findSatuanById = SatuanObat::find($id);
        $findSatuanById->delete();
        $data = [
            'code' => 200,
            'status' => 'OK',
            'data' => [
                'routing' => route('satuan.index')
            ]
        ];
        return response()
            ->json($data);
    }
}
