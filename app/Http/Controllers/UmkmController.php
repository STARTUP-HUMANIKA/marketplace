<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $umkm = Umkm::orderBy('tanggal_ubah', 'ASC')->get();
        $response = [
            'message' => 'List umkm order by time',
            'data' => $umkm 
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
            'id_bumdes' => ['required'],
            'nama' => ['required'],
            'username' => ['required', 'unique:umkm', 'max:125'],
            'password' => ['required'],
            'alamat' => ['required'],
            'telp' => ['required'],
            'foto' => ['required']
        ]);

        $request->request->add([
            'password' => Hash::make($request->password),
            'tanggal_buat' => date("Y-m-d H:i:s")
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $umkm = Umkm::create($request->all());
            $response = [
                'message' => 'Umkm Created',
                'data' => $umkm 
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
        $umkm = Umkm::where('id_umkm', $id)->first();
        $response = [
            'message' => 'Detail of umkm resource',
            'data' => $umkm 
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
        $umkm = Umkm::where('id_umkm', $id)->first();
        
        $validator = Validator::make($request->all(), [
            'id_bumdes' => ['required'],
            'nama' => ['required'],
            'username' => ['required', 'max:125'],
            'password' => ['required'],
            'alamat' => ['required'],
            'telp' => ['required'],
            'foto' => ['required']
        ]);

        $request->request->add([
            'password' => Hash::make($request->password)
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $umkm->where('id_umkm', $id)->update($request->all());
            $response = [
                'message' => 'Umkm Updated',
                'data' => $umkm 
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
        $umkm = Umkm::where('id_umkm', $id); // Add ->firstOrFail() for check data

        try {
            $umkm->delete();
            $response = [
                'message' => 'Umkm Deleted'
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }
}
