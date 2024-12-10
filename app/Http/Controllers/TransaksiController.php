<?php

namespace App\Http\Controllers;

use App\Http\Resources\GudangResource;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::get();

        return new GudangResource(true, 'List Data Transaksi', $transaksi);
    }

    public function show($id)
    {
        //find Transaksi by ID
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Data Transaksi Tidak Ditemukan!',
            ], 404);
        }

        //return single Transaksi as a resource
        return new GudangResource(true, 'Detail Data Transaksi!', $transaksi);
    }

    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'barang_id'           => 'nullable',
            'barang_nama'         => 'nullable',
            'kategori_barang'     => 'nullable',
            'harga_barang'        => 'nullable',
            'stok_barang'         => 'nullable',
            'ukuran_barang'       => 'nullable',
            'jumlah_barang'       => 'nullable',
            'total_harga_barang'  => 'nullable',
            'user_id'             => 'nullable',
            'usernama'            => 'nullable',
            'supplier_id'         => 'nullable',
            'supplier_nama'       => 'nullable',
            'bulan'               => 'nullable',
            'tanggal'             => 'nullable',
            'tanggalAkhir'        => 'nullable',
            'status'              => 'nullable',
            'statusAkhir'         => 'nullable',
        ]);


        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create transaction
        $transaksi = Transaksi::create([
            'barang_id'           => $request->barang_id,
            'barang_nama'         => $request->barang_nama,
            'kategori_barang'     => $request->kategori_barang,
            'harga_barang'        => $request->harga_barang,
            'stok_barang'         => $request->stok_barang,
            'ukuran_barang'       => $request->ukuran_barang,
            'jumlah_barang'       => $request->jumlah_barang,
            'total_harga_barang'  => $request->total_harga_barang,
            'user_id'             => $request->user_id,
            'usernama'            => $request->usernama,
            'supplier_id'         => $request->supplier_id,
            'supplier_nama'       => $request->supplier_nama,
            'bulan'               => $request->bulan,
            'tanggal'             => $request->tanggal,
            'tanggalAkhir'        => $request->tanggalAkhir,
            'status'              => $request->status,
            'statusAkhir'         => $request->statusAkhir,
        ]);

        //return response
        return new GudangResource(true, 'Data Transaksi Berhasil Ditambahkan!', $transaksi);
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'barang_id'           => 'nullabel',
            'barang_nama'         => 'nullabel',
            'kategori_barang'     => 'nullabel',
            'harga_barang'        => 'nullabel',
            'stok_barang'         => 'nullabel',
            'ukuran_barang'       => 'nullabel',
            'jumlah_barang'       => 'nullabel',
            'total_harga_barang'  => 'nullabel',
            'user_id'             => 'nullabel',
            'usernama'            => 'nullabel',
            'supplier_id'         => 'nullabel',
            'supplier_nama'       => 'nullabel',
            'bulan'               => 'nullabel',
            'tanggal'             => 'nullabel',
            'tanggalAkhir'        => 'nullabel',
            'status'              => 'nullabel',
            'statusAkhir'         => 'nullabel',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find transaction by ID
        $transaksi = Transaksi::find($id);

        // Check if transaction not found
        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Data Transaksi Tidak Ditemukan!',
            ], 404);
        }

        // Update transaction
        $transaksi->update($request->all());

        // Return response
        return new GudangResource(true, 'Data Transaksi Berhasil Diuabh!', $transaksi);
    }

    public function destroy($id)
    {
        // Find transaction by ID
        $transaksi = Transaksi::find($id);

        // Check if transaction exists
        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Data Transaksi Tidak Ditemukan!',
            ], 404);
        }

        // Delete transaction
        $transaksi->delete();

        // Return response
        return new GudangResource(true, 'Data Transaksi Berhasil Dihapus!', $transaksi);
    }
}