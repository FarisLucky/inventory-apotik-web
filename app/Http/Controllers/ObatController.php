<?php

namespace App\Http\Controllers;

use App\Models\KategoriObat;
use App\Models\Obat;
use App\Models\SatuanObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ObatController extends Controller
{
    public function index()
    {
        $findObatById = Obat::all();
        $data = [
            'obat' => $findObatById
        ];
        return view('modules.obat.index', $data);
    }
    public function create()
    {
        $findAllSatuan = SatuanObat::all();
        $findAllKategori = KategoriObat::all();
        $data = [
            'satuan' => $findAllSatuan,
            'kategori' => $findAllKategori
        ];
        return view('modules.obat.create', $data);
    }
    public function store(Request $request)
    {
        $rules = [
            'nama_obat' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
            'stock' => 'required',
        ];
        $message = [
            'required' => ':attribute Tidak Boleh Kosong',
        ];
        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            return redirect()
                ->route('obat.create')
                ->withErrors($validation)
                ->withInput();
        }

        $obat = new Obat;
        $obat->no_batch = $request->no_batch;
        $obat->nama_obat = $request->nama_obat;
        $obat->id_kategori = $request->kategori;
        $obat->id_satuan = $request->satuan;
        $obat->stock = $request->stock;
        $obat->save();
        return redirect()
            ->route('obat.create')
            ->with('success', true);
    }
    public function edit($id)
    {
        $findObatById = Obat::find($id);
        $findAllSatuan = SatuanObat::all();
        $findAllKategori = KategoriObat::all();
        $data = [
            'obat' => $findObatById,
            'satuan' => $findAllSatuan,
            'kategori' => $findAllKategori,
        ];
        return view('modules.obat.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'nama_obat' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
            'stock' => 'required',
        ];
        $message = [
            'required' => ':attribute Tidak Boleh Kosong',
        ];
        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            return redirect()
                ->route('obat.edit')
                ->withErrors($validation)
                ->withInput();
        }

        $findObatById = Obat::find($id);
        $findObatById->no_batch = $request->no_batch;
        $findObatById->nama_obat = $request->nama_obat;
        $findObatById->id_kategori = $request->kategori;
        $findObatById->id_satuan = $request->satuan;
        $findObatById->stock = $request->stock;
        $findObatById->save();
        return redirect()
            ->route('obat.edit', ['id_obat' => $id])
            ->with('success', true);
    }
    public function destroy($id)
    {
        $findObatById = Obat::find($id);
        $findObatById->delete();
        $data = [
            'code' => 200,
            'status' => 'OK',
            'data' => [
                'routing' => route('obat.index')
            ],
        ];
        return response()
            ->json($data);
    }
}
