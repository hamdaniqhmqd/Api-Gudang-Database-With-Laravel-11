<?php

namespace App\Http\Controllers;

use App\Http\Resources\GudangResource;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::latest()->get();

        return new GudangResource(true, 'List Data Barang', $barang);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'barang_nama' => 'required',
            'kategori_barang' => 'required',
            'harga_barang' => 'required',
            'stok_barang' => 'required',
            'ukuran_barang' => 'required',
            'jumlah_barang' => 'required',
            'supplier_id' => 'required',
            'insert' => '',
            'update' => '',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $barang = Barang::create([
            'barang_nama' => $request->barang_nama,
            'kategori_barang' => $request->kategori_barang,
            'harga_barang' => $request->harga_barang,
            'stok_barang' => $request->stok_barang,
            'ukuran_barang' => $request->ukuran_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'supplier_id' => $request->supplier_id,
            'insert' => $request->insert,
            'update' => $request->update,
        ]);

        return new GudangResource(true, 'Data Barang Berhasil Ditambahkan!', $barang);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //find Admin by ID
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Data Barang Tidak Ditemukan!',
            ], 404);
        }

        //return single barang as a resource
        return new GudangResource(true, 'Detail Data Barang!', $barang);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $admin = Barang::find($id);

        if (!$admin) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'barang_nama' => 'required',
            'kategori_barang' => 'required',
            'harga_barang' => 'required',
            'stok_barang' => 'required',
            'ukuran_barang' => 'required',
            'jumlah_barang' => 'required',
            'supplier_id' => 'required',
            'insert' => '',
            'update' => '',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $admin->update([
            'barang_nama' => $request->barang_nama,
            'kategori_barang' => $request->kategori_barang,
            'harga_barang' => $request->harga_barang,
            'stok_barang' => $request->stok_barang,
            'ukuran_barang' => $request->ukuran_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'supplier_id' => $request->supplier_id,
            'insert' => $request->insert,
            'update' => $request->update,
        ]);

        return new GudangResource(true, 'Data Barang Berhasil Diubah!', $admin);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        $barang->delete();

        return new GudangResource(true, 'Data Barang Berhasil Dihapus!', $barang);
    }

    // Fungsi untuk mendapatkan barang berdasarkan supplier_id
    public function getBarangBySupplier($supplierId)
    {
        // Query menggunakan Eloquent
        $barang = Barang::where('supplier_id', $supplierId)
            ->orderBy('supplier_id', 'asc')
            ->get();

        // Periksa apakah data barang ditemukan
        if ($barang->isEmpty()) {
            return new GudangResource(false, 'Tidak ada barang untuk supplier ini.', []);
        }

        // Kembalikan data dalam bentuk JSON dengan list barang
        return new GudangResource(true, 'Data Barang Berhasil Ditemukan!', $barang);
    }
}
