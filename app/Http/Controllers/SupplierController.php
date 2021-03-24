<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $supplier = Supplier::all();
        $data = [
            'supplier' => $supplier
        ];
        return view("modules.supplier.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('modules.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'no_pbf' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'fax' => 'required',
            'email' => 'required|email'
        ];
        $message = [
            'required' => ':attribute Tidak Boleh Kosong',
        ];
        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            return redirect()
                ->route('supplier.create')
                ->withErrors($validation)
                ->withInput();
        }

        $supplier = new Supplier;
        $supplier->no_pbf = $request->no_pbf;
        $supplier->nama_supplier = $request->nama_supplier;
        $supplier->alamat = $request->alamat;
        $supplier->telp = $request->telp;
        $supplier->fax = $request->fax;
        $supplier->email = $request->email;
        $supplier->save();
        return redirect()
            ->route('supplier.create')
            ->with('success', 'Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $supplierById = Supplier::find($id);
        $data = [
            'supplier' => $supplierById
        ];
        return view('modules.supplier.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = [
            'no_pbf' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'fax' => 'required',
            'email' => 'required|email'
        ];
        $message = [
            'required' => ':attribute Tidak Boleh Kosong',
        ];
        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            return redirect()
                ->route('supplier.create')
                ->withErrors($validation)
                ->withInput();
        }

        $findSupplierById = Supplier::find($id);

        $findSupplierById->no_pbf = $request->no_pbf;
        $findSupplierById->nama_supplier = $request->nama_supplier;
        $findSupplierById->alamat = $request->alamat;
        $findSupplierById->telp = $request->telp;
        $findSupplierById->fax = $request->fax;
        $findSupplierById->email = $request->email;
        $findSupplierById->save();
        return redirect()
            ->route('supplier.edit', [
                'id_supplier' => $findSupplierById->id_supplier
            ])
            ->with('success', 'Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        $data = [
            'code' => 200,
            'status' => 'OK',
            'data' => [
                'routing' => route('supplier.index')
            ]
        ];
        return response()
            ->json($data);
    }
}
