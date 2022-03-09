<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    // $id dari id_pelaggan
    public function basedOn($id, $basedOn) {
        $pesanan = Pesanan::where('id_pelanggan', $id)->where('status_pesanan', $basedOn)->get();

        $response = [
            'message' => 'List pesanan order by time',
            'data' => $pesanan 
        ];

        return response()->json($response, Response::HTTP_OK);
    }
    
    public function countCart() {
        $pesanan = Pesanan::selectRaw('count(detail_pesanan.id_detail_pesanan) as total_keranjang')
        ->leftJoin('detail_pesanan', 'pesanan.id_pesanan', '=', 'detail_pesanan.id_pesanan')
        ->groupBy('pesanan.id_pesanan')->get();

        $response = [
            'message' => 'List pesanan order by time',
            'data' => $pesanan 
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function totalPriceOrder($id)
    {
        $pesanan = Pesanan::selectRaw('sum(total_biaya) as total_harga')->where('id_pelanggan', $id)->get();
        $response = [
            'message' => 'List pesanan order by time',
            'data' => $pesanan 
        ];

        return response()->json($response, Response::HTTP_OK);
    }
    
    public function dataOrder($id)
    {
        $pesanan = Pesanan::orderBy('tanggal_pesanan', 'ASC')->where('id_pelanggan', $id)->get();
        $response = [
            'message' => 'List pesanan order by time',
            'data' => $pesanan 
        ];

        return response()->json($response, Response::HTTP_OK);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesanan = Pesanan::orderBy('tanggal_pesanan', 'ASC')->get();
        $response = [
            'message' => 'List pesanan order by time',
            'data' => $pesanan 
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add([
            'kode_pesanan' => Str::random(16),
            'tanggal_pesanan' => date("Y-m-d H:i:s")
        ]);

        $validator = Validator::make($request->all(), [
            'kode_pesanan' => ['required', 'unique:pesanan'], 
            'id_pelanggan' => ['required', 'max:11'], 
            'status_pesanan' => [
                'required', 
                'in:Belum Bayar,Dikemas,Dikirim,Diterima,Diterima,Ditolak,Ditolak,Dibatalkan,Pengembalian'
            ], 
            'alamat_pengiriman' => ['required'], 
            'harga_ongkir' => ['required', 'numeric'], 
            'ekspedisi' => ['required'], 
            'total_biaya' => ['required', 'max:16'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $pesanan = Pesanan::create($request->all());
            $response = [
                'message' => 'Pesanan Created',
                'data' => $pesanan 
            ];

            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pesanan = Pesanan::where('id_pesanan', $id)->first();
        $response = [
            'message' => 'Detail of pesanan resource',
            'data' => $pesanan 
        ];

        return response()->json($response, Response::HTTP_OK);
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
        $pesanan = Pesanan::where('id_pesanan', $id)->first();
        
        $validator = Validator::make($request->all(), [
            'id_pelanggan' => ['required', 'max:11'], 
            'status_pesanan' => [
                'required', 
                'in:Belum Bayar,Dikemas,Dikirim,Diterima,Diterima,Ditolak,Ditolak,Dibatalkan,Pengembalian'
            ], 
            'alamat_pengiriman' => ['required'], 
            'harga_ongkir' => ['required', 'numeric'], 
            'ekspedisi' => ['required'], 
            'total_biaya' => ['required', 'max:16'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $pesanan->where('id_pesanan', $id)->update($request->all());
            $response = [
                'message' => 'Pesanan Updated',
                'data' => $pesanan 
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pesanan = Pesanan::where('id_pesanan', $id); // Add ->firstOrFail() for check data

        try {
            $pesanan->delete();
            $response = [
                'message' => 'Pesanan Deleted'
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }
}
