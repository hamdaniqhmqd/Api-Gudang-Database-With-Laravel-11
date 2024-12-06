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
            'barang_id'           => 'required|integer',
            'barang_nama'         => 'required|string',
            'kategori_barang'     => 'required|string',
            'harga_barang'        => 'required|integer',
            'stok_barang'         => 'required|integer',
            'ukuran_barang'       => 'required|string',
            'jumlah_barang'       => 'required|integer',
            'total_harga_barang'  => 'required|integer',
            'user_id'             => 'required|integer',
            'usernama'            => 'required|string',
            'supplier_id'         => 'required|integer',
            'supplier_nama'       => 'required|string',
            'bulan'               => 'required|string',
            'tanggal'             => 'required|string',
            'tanggalAkhir'        => 'required|string',
            'status'              => 'required|integer',
            'statusAkhir'         => 'required|integer',
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
            'barang_id'           => 'required|integer',
            'barang_nama'         => 'required|string',
            'kategori_barang'     => 'required|string',
            'harga_barang'        => 'required|integer',
            'stok_barang'         => 'required|integer',
            'ukuran_barang'       => 'required|string',
            'jumlah_barang'       => 'required|integer',
            'total_harga_barang'  => 'required|integer',
            'user_id'             => 'required|integer',
            'usernama'            => 'required|string',
            'supplier_id'         => 'required|integer',
            'supplier_nama'       => 'required|string',
            'bulan'               => 'required|string',
            'tanggal'             => 'required|string',
            'tanggalAkhir'        => 'required|string',
            'status'              => 'required|integer',
            'statusAkhir'         => 'required|integer',
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
