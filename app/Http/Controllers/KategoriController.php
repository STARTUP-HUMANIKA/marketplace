<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::orderBy('tanggal_ubah', 'ASC')->get();
        $response = [
            'message' => 'List kategori order by time',
            'data' => $kategori 
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
            'nama_kategori' => ['required', 'max:256'],
        ]);

        $request->request->add([
            'tanggal_buat' => date("Y-m-d H:i:s")
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $kategori = Kategori::create($request->all());
            $response = [
                'message' => 'Kategori Created',
                'data' => $kategori 
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
        $kategori = Kategori::where('id_kategori', $id)->first();
        $response = [
            'message' => 'Detail of kategori resource',
            'data' => $kategori 
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
        $kategori = Kategori::where('id_kategori', $id)->first();
        
        $validator = Validator::make($request->all(), [
            'nama_kategori' => ['required', 'max:256'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $kategori->where('id_kategori', $id)->update($request->all());
            $response = [
                'message' => 'Kategori Updated',
                'data' => $kategori 
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
        $kategori = Kategori::where('id_kategori', $id); // Add ->firstOrFail() for check data

        try {
            $kategori->delete();
            $response = [
                'message' => 'Kategori Deleted'
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }
}
