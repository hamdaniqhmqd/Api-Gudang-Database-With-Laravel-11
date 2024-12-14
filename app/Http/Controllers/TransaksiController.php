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
        $transaksi = Transaksi::latest()->get();

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
            'barang_id'           => 'required',
            'jumlah_barang'       => 'required',
            'total_harga_barang'  => 'required',
            'user_id'             => 'required',
            'supplier_id'         => 'required',
            'bulan'               => 'required',
            'tanggal'             => 'required',
            'tanggalAkhir'        => 'required',
            'status'              => 'required',
            'statusAkhir'         => 'nullable',
            'insert' => '',
            'update' => '',
        ]);


        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create transaction
        $transaksi = Transaksi::create([
            'barang_id'           => $request->barang_id,
            'jumlah_barang'       => $request->jumlah_barang,
            'total_harga_barang'  => $request->total_harga_barang,
            'user_id'             => $request->user_id,
            'supplier_id'         => $request->supplier_id,
            'bulan'               => $request->bulan,
            'tanggal'             => $request->tanggal,
            'tanggalAkhir'        => $request->tanggalAkhir,
            'status'              => $request->status,
            'statusAkhir'         => $request->statusAkhir,
            'insert' => $request->insert,
            'update' => $request->update,
        ]);

        //return response
        return new GudangResource(true, 'Data Transaksi Berhasil Ditambahkan!', $transaksi);
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'barang_id'           => 'required',
            'jumlah_barang'       => 'required',
            'total_harga_barang'  => 'required',
            'user_id'             => 'required',
            'supplier_id'         => 'required',
            'bulan'               => 'required',
            'tanggal'             => 'required',
            'tanggalAkhir'        => 'required',
            'status'              => 'required',
            'statusAkhir'         => 'required',
            'insert' => '',
            'update' => '',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find transaction by ID
        $transaksi = Transaksi::find($id);

        // Check if transaction not found
        if (!$transaksi) {
            return new GudangResource(false, 'Data Transaksi Berhasil Diubah!', $transaksi);
        }

        // Update transaction
        $transaksi->update([
            'barang_id'           => $request->barang_id,
            'jumlah_barang'       => $request->jumlah_barang,
            'total_harga_barang'  => $request->total_harga_barang,
            'user_id'             => $request->user_id,
            'supplier_id'         => $request->supplier_id,
            'bulan'               => $request->bulan,
            'tanggal'             => $request->tanggal,
            'tanggalAkhir'        => $request->tanggalAkhir,
            'status'              => $request->status,
            'statusAkhir'         => $request->statusAkhir,
            'insert' => $request->insert,
            'update' => $request->update,
        ]);

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