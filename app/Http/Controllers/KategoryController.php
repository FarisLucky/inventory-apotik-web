<?php

namespace App\Http\Controllers;

use App\Models\KategoriObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoryController extends Controller
{
    public function index()
    {
        $findAllkategori = kategoriObat::all();
        $data = [
            'kategori' => $findAllkategori
        ];
        return view('modules.kategori.index', $data);
    }

    public function create()
    {
        return view('modules.kategori.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'kategori' => 'required'
        ];
        $message = [
            'required' => ':attribute Tidak Boleh Kosong',
        ];
        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            return redirect()
                ->route('kategori.create')
                ->withErrors($validation)
                ->withInput();
        }

        $kategori = new KategoriObat;
        $kategori->kategori = $request->kategori;
        $kategori->save();

        return redirect()
            ->route('kategori.create')
            ->with('success', true);
    }

    public function edit($id)
    {
        $findkategoriById = KategoriObat::find($id);
        $data = [
            'kategori' => $findkategoriById
        ];
        return view('modules.kategori.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $findkategoriById = KategoriObat::find($id);
        $findkategoriById->kategori = $request->kategori;
        $findkategoriById->save();
        return redirect()
            ->route('kategori.edit', ["id_kategori" => $findkategoriById->id_kategori])
            ->with('success', true);
    }

    public function destroy($id)
    {
        $findkategoriById = KategoriObat::find($id);
        $findkategoriById->delete();
        $data = [
            'code' => 200,
            'status' => 'OK',
            'data' => [
                'routing' => route('kategori.index')
            ]
        ];
        return response()
            ->json($data);
    }
}
