<?php

namespace App\Http\Controllers;

use App\Models\SubKategori;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SubKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subKategori = SubKategori::orderBy('tanggal_ubah', 'ASC')->get();
        $response = [
            'message' => 'List subKategori order by time',
            'data' => $subKategori 
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
            'id_kategori' => ['required', 'max:11'],
            'nama_sub_kategori' => ['required', 'max:256'],
        ]);

        $request->request->add([
            'tanggal_buat' => date("Y-m-d H:i:s")
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $subKategori = SubKategori::create($request->all());
            $response = [
                'message' => 'subKategori Created',
                'data' => $subKategori 
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
        $subKategori = SubKategori::where('id_sub_kategori', $id)->first();
        $response = [
            'message' => 'Detail of subKategori resource',
            'data' => $subKategori 
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
        $subKategori = SubKategori::where('id_sub_kategori', $id)->first();
        
        $validator = Validator::make($request->all(), [
            'id_kategori' => ['required', 'max:11'],
            'nama_sub_kategori' => ['required', 'max:256'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $subKategori->where('id_sub_kategori', $id)->update($request->all());
            $response = [
                'message' => 'SubKategori Updated',
                'data' => $subKategori 
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
        $subKategori = SubKategori::where('id_sub_kategori', $id); // Add ->firstOrFail() for check data

        try {
            $subKategori->delete();
            $response = [
                'message' => 'SubKategori Deleted'
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }
}
