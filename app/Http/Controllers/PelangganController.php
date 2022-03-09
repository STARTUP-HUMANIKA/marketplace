<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    
    public function index()
    {
        $pelanggan = Pelanggan::orderBy('tanggal_ubah', 'ASC')->get();
        $response = [
            'message' => 'List pelanggan order by time',
            'data' => $pelanggan 
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
            'nama_pelanggan' => ['required', 'max:165'],
            'email' => ['required', 'email', 'unique:pelanggan', 'max:125'],
            'password' => ['required'],
            'alamat' => ['required'],
            'telp' => ['required'],
            'foto' => ['required'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:pria,wanita']
        ]);

        $request->request->add([
            'password' => Hash::make($request->password),
            'tanggal_buat' => date("Y-m-d H:i:s")
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $pelanggan = Pelanggan::create($request->all());
            $response = [
                'message' => 'Pelanggan Created',
                'data' => $pelanggan 
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
        $pelanggan = Pelanggan::where('id_pelanggan', $id)->first();
        $response = [
            'message' => 'Detail of pelanggan resource',
            'data' => $pelanggan 
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
        $pelanggan = Pelanggan::where('id_pelanggan', $id)->first();
        
        $validator = Validator::make($request->all(), [
            'nama_pelanggan' => ['required', 'max:256'],
            'email' => ['required', 'email', 'max:125'],
            'password' => ['required'],
            'alamat' => ['required'],
            'telp' => ['required'],
            'foto' => ['required'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:pria,wanita']
        ]);

        $request->request->add([
            'password' => Hash::make($request->password),
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $pelanggan->where('id_pelanggan', $id)->update($request->all());
            $response = [
                'message' => 'Pelanggan Updated',
                'data' => $pelanggan 
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
        $pelanggan = Pelanggan::where('id_pelanggan', $id); // Add ->firstOrFail() for check data

        try {
            $pelanggan->delete();
            $response = [
                'message' => 'Pelanggan Deleted'
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }
}
