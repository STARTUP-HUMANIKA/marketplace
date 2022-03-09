<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DetailPesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detailPesanan = DetailPesanan::orderBy('id_detail_pesanan', 'DESC')->get();
        $response = [
            'message' => 'List Detail Pesanan order by time',
            'data' => $detailPesanan 
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
        $validator = Validator::make($request->all(), [
            'id_pesanan' => ['required', 'max:11'], 
            'id_produk' => ['required', 'max:11'],
            'jumlah' => ['required', 'max:4'], 
            'harga_jual' => ['required', 'max:16'], 
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $detailPesanan = DetailPesanan::create($request->all());
            $response = [
                'message' => 'Detail Pesanan Created',
                'data' => $detailPesanan 
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
        $detailPesanan = DetailPesanan::where('id_detail_pesanan', $id)->first();
        $response = [
            'message' => 'Detail of Detail Pesanan resource',
            'data' => $detailPesanan 
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
        $detailPesanan = DetailPesanan::where('id_detail_pesanan', $id)->first();
        
        $validator = Validator::make($request->all(), [
            'id_pesanan' => ['required', 'max:11'], 
            'id_produk' => ['required', 'max:11'],
            'jumlah' => ['required', 'max:4'], 
            'harga_jual' => ['required', 'max:16'], 
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $detailPesanan->where('id_detail_pesanan', $id)->update($request->all());
            $response = [
                'message' => 'Detail Pesanan Updated',
                'data' => $detailPesanan 
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
        $detailPesanan = DetailPesanan::where('id_detail_pesanan', $id); // Add ->firstOrFail() for check data

        try {
            $detailPesanan->delete();
            $response = [
                'message' => 'Detail Pesanan Deleted'
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }
}
