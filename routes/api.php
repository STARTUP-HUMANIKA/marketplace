<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BumdesController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SubKategoriController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DetailPesananController;
use App\Http\Controllers\RatingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/transaction', [TransactionController::class, 'index']);
// Route::post('/transaction', [TransactionController::class, 'store']);
// Route::get('/transaction/{id}', [TransactionController::class, 'show']);
// Route::put('/transaction/{id}', [TransactionController::class, 'update']);
// Route::delete('/transaction/{id}', [TransactionController::class, 'destroy']);

// Route::resource('/transaction', TransactionController::class);

// HomeScreen
Route::get('/cari/{name}', [ProdukController::class, 'search']);
Route::get('/totalKeranjang', [PesananController::class, 'countCart']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/bumdes', [BumdesController::class, 'index']);
Route::get('/produk', [ProdukController::class, 'index']);

//Products
Route::post('/cari/{name}', [ProdukController::class, 'filter']);

//Detail Products
Route::get('/detailProduk/{id}', [ProdukController::class, 'detailProduct']);
Route::get('/rating/{id}', [RatingController::class, 'index']);
Route::resource('/rating', RatingController::class)->except(['index','create', 'edit']);
Route::get('/produkLain/{id}', [ProdukController::class, 'otherProduct']);
Route::get('/produkYangSama/{id}', [ProdukController::class, 'similarProduct']);

//Detail Products
Route::get('/dataOrder/{id}', [PesananController::class, 'dataOrder']);
Route::get('/totalPriceOrder/{id}', [PesananController::class, 'totalPriceOrder']);

//Customer Profile
Route::get('/dataCustomer/{id}', [PelangganController::class, 'show']);
Route::get('/updateCustomer/{id}', [PelangganController::class, 'update']);
Route::get('/statusPesanan/{id}/{basedOn}', [PesananController::class, 'basedOn']);

//Bumdes Profile
Route::get('/dataBumdes/{id}', [BumdesController::class, 'show']);
Route::get('/updateBumdes/{id}', [BumdesController::class, 'update']);
Route::get('/produkBumdes/{id}', [ProdukController::class, 'ProductBumdes']);


// Route::get('/bumdes', [BumdesController::class, 'index']);
// Route::resource('/bumdes', BumdesController::class)->except(['create', 'edit']);
// Route::resource('/umkm', UmkmController::class)->except(['create', 'edit']);
// Route::resource('/kategori', KategoriController::class)->except(['create', 'edit']);
// Route::resource('/subkategori', SubKategoriController::class)->except(['create', 'edit']);
// Route::resource('/pelanggan', PelangganController::class)->except(['create', 'edit']);
// Route::resource('/produk', ProdukController::class)->except(['create', 'edit']);
// Route::resource('/pesanan', PesananController::class)->except(['create', 'edit']);
// Route::resource('/detailpesanan', DetailPesananController::class)->except(['create', 'edit']);
// Route::resource('/rating', RatingController::class)->except(['create', 'edit']);