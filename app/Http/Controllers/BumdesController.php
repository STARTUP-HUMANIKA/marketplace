<?php

namespace App\Http\Controllers;

use App\Models\Bumdes;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class BumdesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bumdes = Bumdes::orderBy('tanggal_ubah', 'ASC')->limit(10)->get();
        $response = [
            'message' => 'List bumdes order by time',
            'data' => $bumdes 
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
            'nama' => ['required'],
            'email' => ['required', 'email', 'unique:bumdes', 'max:125'],
            'password' => ['required'],
            'alamat' => ['required'],
            'telp' => ['required'],
            'foto' => ['required']
        ]);

        $request->request->add([
            'password' => Hash::make($request->password),
            ['tanggal_buat' => date("Y-m-d H:i:s")]
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $bumdes = Bumdes::create($request->all());
            $response = [
                'message' => 'bumdes Created',
                'data' => $bumdes 
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
        $bumdes = Bumdes::where('id_bumdes', $id)->first();
        $response = [
            'message' => 'Detail of bumdes resource',
            'data' => $bumdes 
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
        $bumdes = Bumdes::where('id_bumdes', $id)->firstOrFail();
        
        $validator = Validator::make($request->all(), [
            'nama' => ['required'],
            'email' => ['required', 'string', 'max:125'],
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
            $bumdes->where('id_bumdes', $id)->update($request->all());
            $response = [
                'message' => 'Bumdes Updated',
                'data' => $bumdes 
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
        $bumdes = Bumdes::where('id_bumdes', $id); // Add ->firstOrFail() for check data

        try {
            $bumdes->delete();
            $response = [
                'message' => 'Bumdes Deleted'
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }
}
