<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\FotoProduk;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProdukController extends Controller
{
    // Pencarian Produk
    public function search($name) {
        // $name = $request->input('nama_produk');
        $produk = Produk::where('nama_produk', 'like', '%'.$name.'%')->orderBy('tanggal_ubah', 'ASC')->get();
        $response = [
            'message' => 'Hasil pencarian produk \'' .$name. '\'',
            'data' => $produk 
        ];

        return response()->json($response, Response::HTTP_OK);
    }
    
    // Filter Produk
    public function filter(Request $request, $name) {
        $idSubKategori = $request->input('id_sub_kategori');
        $hargaTerendah = $request->input('hargaTerendah');
        $hargaTertinggi = $request->input('hargaTertinggi');
        // $namaBumdes = $request->input('namaBumdes');
        $produk = Produk::where('nama_produk', 'like', '%'.$name.'%')
                        ->orWhere('id_sub_kategori', $idSubKategori)
                        ->whereBetween('harga_produk', [$hargaTerendah, $hargaTertinggi])
                        ->orderBy('tanggal_ubah', 'ASC')->get();
        $response = [
            'message' => 'Hasil pencarian produk \'' .$name. '\'',
            'data' => $produk 
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    // Detail Produk
    public function detailProduct($id) {
        $produk = Produk::select('produk.*', 'bumdes.alamat')
                        ->leftJoin('umkm', 'umkm.id_umkm', '=', 'produk.id_umkm')
                        ->leftJoin('bumdes', 'bumdes.id_bumdes', '=', 'umkm.id_bumdes')
                        ->where('id_produk', $id)->first();
        $produk['foto'] = FotoProduk::where('id_produk', $id)->get();

        $response = [
            'message' => 'List detail produk',
            'data' => $produk 
        ];

        return response()->json($response, Response::HTTP_OK);
    }
    
    // Produk yang sama dengan bumdes tersebut
    // id yang dikirim yaitu id_umkm (get data id_umkm)
    public function otherProduct($id) {
        $id_bumdes = Umkm::selectRaw('id_bumdes')->where('id_umkm', $id)->first();
        $produk = Produk::selectRaw('produk.*, (SELECT foto FROM foto_produk WHERE id_produk = produk.id_produk LIMIT 1) as foto')
                        ->leftJoin('umkm', 'umkm.id_umkm', '=', 'produk.id_umkm')
                        ->leftJoin('bumdes', 'bumdes.id_bumdes', '=', 'umkm.id_bumdes')
                        ->where('bumdes.id_bumdes', $id_bumdes['id_bumdes'])
                        ->limit(10)->get();

        $response = [
            'message' => 'List detail produk',
            'data' => $produk 
        ];

        return response()->json($response, Response::HTTP_OK);
    }
    
    // Produk yang sama dengan produk tersebut
    // id yang dikirim yaitu id_kategori
    public function similarProduct($id) {
        $produk = Produk::selectRaw('produk.*, (SELECT foto FROM foto_produk WHERE id_produk = produk.id_produk LIMIT 1) as foto')
                        ->where('id_produk', $id)->get();

        $response = [
            'message' => 'List detail produk',
            'data' => $produk 
        ];
        
        return response()->json($response, Response::HTTP_OK);
    }
    
    // id yang dikirim yaitu id_umkm (get data id_umkm)
    public function ProductBumdes($id) {
        $produk = Produk::selectRaw('produk.*, (SELECT foto FROM foto_produk WHERE id_produk = produk.id_produk LIMIT 1) as foto')
                        ->leftJoin('umkm', 'umkm.id_umkm', '=', 'produk.id_umkm')
                        ->leftJoin('bumdes', 'bumdes.id_bumdes', '=', 'umkm.id_bumdes')
                        ->where('bumdes.id_bumdes', $id)
                        ->limit(10)->get();

        $response = [
            'message' => 'List detail produk',
            'data' => $produk 
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Data Semua Produk
    public function index()
    {
        $produk = Produk::orderBy('tanggal_ubah', 'ASC')->get();
        $response = [
            'message' => 'List produk order by time',
            'data' => $produk 
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
            'id_umkm' => ['required', 'max:11'],
            'id_sub_kategori' => ['required', 'max:11'],
            'nama_produk' => ['required', 'max:256'],
            'harga_produk' => ['required', 'numeric'],
            'deskripsi' => ['required']
        ]);

        $request->request->add([
            'tanggal_buat' => date("Y-m-d H:i:s")
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $produk = Produk::create($request->all());
            $response = [
                'message' => 'Produk Created',
                'data' => $produk 
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
        $produk = Produk::where('id_produk', $id)->first();
        $response = [
            'message' => 'Detail of produk resource',
            'data' => $produk 
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
        $produk = Produk::where('id_produk', $id)->first();
        
        $validator = Validator::make($request->all(), [
            'id_umkm' => ['required', 'max:11'],
            'id_sub_kategori' => ['required', 'max:11'],
            'nama_produk' => ['required', 'max:256'],
            'harga_produk' => ['required', 'numeric'],
            'deskripsi' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $produk->where('id_produk', $id)->update($request->all());
            $response = [
                'message' => 'Produk Updated',
                'data' => $produk 
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
        $produk = Produk::where('id_produk', $id); // Add ->firstOrFail() for check data

        try {
            $produk->delete();
            $response = [
                'message' => 'Produk Deleted'
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed " . $e->errorInfo
            ]);
        }
    }
}
