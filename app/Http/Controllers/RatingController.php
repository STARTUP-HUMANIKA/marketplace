<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $rating = Rating::where('id_produk', $id)->orderBy('tanggal_ubah', 'DESC')->get();
        
        $response = [
            'message' => 'List Rating order by time',
            'data' => $rating 
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
            'id_pelanggan' => ['required', 'max:11'],
            'id_produk' => ['required', 'max:11'],
            'rating' => ['required', 'numeric', 'max:5'], 
            'catatan' => ['required'], 
        ]);

        $request->request->add([
            'tanggal_buat' => date("Y-m-d H:i:s")
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $rating = Rating::create($request->all());
            $response = [
                'message' => 'Rating Created',
                'data' => $rating 
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
        $rating = Rating::where('id_rating', $id)->first();
        $response = [
            'message' => 'Detail of Rating resource',
            'data' => $rating 
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
        $rating = Rating::where('id_rating', $id)->first();
        
        $validator = Validator::make($request->all(), [
            'id_pelanggan' => ['required', 'max:11'],
            'id_produk' => ['required', 'max:11'],
            'rating' => ['required', 'numeric', 'max:5'], 
            'catatan' => ['required'], 
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $rating->where('id_rating', $id)->update($request->all());
            $response = [
                'message' => 'Rating Updated',
                'data' => $rating 
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
        $rating = Rating::where('id_rating', $id); // Add ->firstOrFail() for check data

        try {
            $rating->delete();
            $response = [
                'message' => 'Rating Deleted'
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }
}
