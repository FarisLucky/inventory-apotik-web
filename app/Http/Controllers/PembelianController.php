<?php

namespace App\Http\Controllers;

use App\Http\Requests\pembelian\PembelianFormRequest;
use App\Http\Resources\ObatCookies;
use App\Models\DetailPembelian;
use App\Models\Obat;
use App\Models\Pembelian;
use App\Models\Supplier;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PembelianController extends Controller
{

    public function index()
    {
        $findAllPembelian = Pembelian::all();
        $data = [
            'pembelian' => $findAllPembelian
        ];
        return view("modules.pembelian.index", $data);
    }

    public function rincian($id)
    {
        $findPembelianById = Pembelian::find($id);
        $data = [
            'pembelian' => $findPembelianById,
            'detail' => $findPembelianById->detail
        ];
        // dd($findPembelianById->detail);
        return view("modules.pembelian.rincian", $data);
    }

    public function rincianDetailObat($no_batch)
    {
        $findObatById = Obat::where('no_batch', $no_batch)->first();
        // dd($findObatById->kategori->kategori);
        $data = [
            'code' => 200,
            'status' => 'OK',
            'data' => [
                'obat' => $findObatById,
            ]
        ];
        return response()
            ->json($data);
    }

    public function show()
    {
        $findAllSupplier = Supplier::all();
        $findAllObat = Obat::all();
        $findFakturFromCookie = null;
        $findObatFromCookie = null;
        $cookie = json_decode(request()->cookie('lara_list'), true);
        if ($cookie && array_key_exists('obat', $cookie)) {
            $findObatFromCookie = $cookie['obat'];
        }
        if ($cookie && array_key_exists('faktur', $cookie)) {
            $findFakturFromCookie = $cookie['faktur'];
        }
        $data = [
            'supplier' => $findAllSupplier,
            'obat' => $findAllObat,
            'list_obat' => $findObatFromCookie,
            'faktur' => $findFakturFromCookie
        ];
        return view('modules.pembelian.form_main', $data);
    }

    /**
     * @param PembelianFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function tambahObat(PembelianFormRequest $request)
    {
        $input = $request->validated();
        $cookie = json_decode($request->cookie('lara_list'), true);
        $findObatById = Obat::find($input['obat']);
        if ($cookie && array_key_exists('obat', $cookie)) {
            $obat_baru = [
                'id_obat' => $findObatById->id_obat,
                'no_batch' => $findObatById->no_batch,
                'nama_obat' => $findObatById->nama_obat,
                'harga_beli' => $input['harga_beli'],
                'jumlah' => $input['jumlah'],
                'diskon' => $input['diskon'],
            ];
            array_push($cookie['obat'], $obat_baru);
        } else {
            $cookie['obat'] = array([
                'id_obat' => $findObatById->id_obat,
                'no_batch' => $findObatById->no_batch,
                'nama_obat' => $findObatById->nama_obat,
                'harga_beli' => $input['harga_beli'],
                'jumlah' => $input['jumlah'],
                'diskon' => $input['diskon'],
            ]);
        }
        $setCookie = cookie('lara_list', json_encode($cookie));
        return redirect()
            ->route('pembelian.show')
            ->cookie($setCookie)
            ->with('success_obat', true);
    }

    public function editObat(Request $request, $id)
    {
        $cookie = json_decode($request->cookie('lara_list'), true);
        $data = [
            'code' => 200,
            'status' => 'OK',
            'data' => [
                'id' => $id,
                'obat' => $cookie['obat'][$id]
            ]
        ];
        return response()
            ->json($data);
    }

    public function updateObat(Request $request)
    {
        $cookie = json_decode($request->cookie('lara_list'), true);
        // dd($request->id_obat);
        try {
            $id = (int) $request->id;
            // dd($request);
            $cookie['obat'][$id] = [
                'id_obat' => (int) $request->id_obat,
                'no_batch' => (int) $request->no_batch,
                'nama_obat' => $request->nama_obat,
                'harga_beli' => (int) $request->harga_beli,
                'jumlah' => (int) $request->jumlah,
                'diskon' => (int) $request->diskon,
            ];

            $data = [
                'code' => 200,
                'status' => 'OK',
                'data' => [
                    'routing' => route('pembelian.show')
                ]
            ];
            $setCookie = cookie('lara_list', json_encode($cookie));
            $response = new Response("JSONable");
            return $response
                ->setContent($data)
                ->withCookie($setCookie);
        } catch (Exception $th) {
            Log::debug($th);
            $data = [
                'code' => 500,
                'status' => 'Internal Server Error',
                'data' => $th
            ];
            return response()
                ->json($data);
        }
    }

    public function destroyObat($id)
    {
        $cookie = json_decode(Cookie::get('lara_list'), true);

        try {
            unset($cookie['obat'][$id]);

            $setCookie = cookie('lara_list', json_encode($cookie));

            $data = [
                'code' => 200,
                'status' => 'OK',
                'data' => [
                    'routing' => route('pembelian.show')
                ]
            ];

            $response = new Response("JSONable");
            return $response
                ->setContent($data)
                ->withCookie($setCookie);
        } catch (Exception $th) {
            Log::debug($th);
            $data = [
                'code' => 500,
                'status' => 'Internal Server Error',
                'data' => $th
            ];
            return response()
                ->json($data);
        }
    }

    public function destroyAllObat()
    {
        $cookie = json_decode(Cookie::get('lara_list'), true);

        try {
            unset($cookie['obat']);

            $setCookie = cookie('lara_list', json_encode($cookie));

            $data = [
                'code' => 200,
                'status' => 'OK',
                'data' => [
                    'routing' => route('pembelian.show')
                ]
            ];

            $response = new Response("JSONable");
            return $response
                ->setContent($data)
                ->withCookie($setCookie);
        } catch (Exception $th) {
            Log::debug($th);
            $data = [
                'code' => 500,
                'status' => 'Internal Server Error',
                'data' => $th
            ];
            return response()
                ->json($data);
        }
    }

    public function tambahFaktur(Request $request)
    {
        $rule = [
            'no_faktur' => 'required',
            'supplier' => 'required',
            'jth_tempo' => 'required|date_format:Y-m-d'
        ];

        $message = [
            'required' => ':attribute tidak boleh kosong',
            'date_format:Y-m-d' => ':attribute sesuai dengan format Y-m-d',
        ];

        $validation = Validator::make($request->all(), $rule, $message);
        if ($validation->fails()) {
            return redirect()
                ->route('pembelian.show')
                ->withErrors($validation)
                ->withInput();
        }

        $cookie = json_decode($request->cookie('lara_list'), true);
        $findSupplierById = Supplier::find($request->supplier);
        $cookie_faktur = array(
            'no_faktur' => $request->no_faktur,
            'supplier' => $findSupplierById->id_supplier,
            'jth_tempo' => $request->jth_tempo,
        );
        $cookie['faktur'] = $cookie_faktur;
        $setCookie = cookie('lara_list', json_encode($cookie));
        return redirect()
            ->route('pembelian.show')
            ->cookie($setCookie)
            ->with('success_faktur', true);
    }

    public function store(Request $request)
    {
        $cookie = json_decode($request->cookie('lara_list'), true);
        if (
            $cookie &&
            array_key_exists('obat', $cookie) &&
            array_key_exists('faktur', $cookie)
        ) {
            DB::beginTransaction();
            try {
                $pembelian = new Pembelian;
                $pembelian->no_faktur = $cookie['faktur']['no_faktur'];
                $pembelian->tgl_jatuh_tempo = $cookie['faktur']['jth_tempo'];
                $pembelian->tgl_transaksi = Carbon::now();
                $pembelian->id_supplier = $cookie['faktur']['supplier'];
                $pembelian->id_akun = Auth::user()->id;
                $pembelian->total = 20000;
                $pembelian->save();
                $id_pembelian = $pembelian->id;

                foreach ($cookie['obat'] as $obat) {
                    $detailPembelian = new DetailPembelian;
                    $detailPembelian->id_pembelian = $id_pembelian;
                    $detailPembelian->no_batch = $obat['no_batch'];
                    $detailPembelian->diskon = $obat['diskon'];
                    $detailPembelian->harga_beli = $obat['harga_beli'];
                    $detailPembelian->quantity = $obat['jumlah'];
                    $detailPembelian->save();
                }
                DB::commit();
                Cookie::queue(
                    Cookie::forget('lara_list')
                );

                $data = [
                    'code' => 200,
                    'status' => 'OK',
                    'data' => [
                        'routing' => route('pembelian.show')
                    ]
                ];
                return response()
                    ->json($data);
            } catch (\Exception $ex) {
                DB::rollback();
                Log::debug($ex);
                $data = [
                    'code' => 500,
                    'status' => 'Internal Server Error',
                    'data' => [
                        'routing' => route('pembelian.show')
                    ]
                ];
                return response()
                    ->json($data);
            }
        }
    }
}
