<?php

namespace App\Http\Controllers;

use App\Http\Resources\GudangResource;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::latest()->get();

        return new GudangResource(true, 'List Data Supplier', $supplier);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_supplier' => 'required',
            'nik_supplier' => 'required',
            'no_hp_supplier' => 'required',
            'insert' => '',
            'update' => '',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $supplier = Supplier::create([
            'nama_supplier' => $request->nama_supplier,
            'nik_supplier' => $request->nik_supplier,
            'no_hp_supplier' => $request->no_hp_supplier,
            'insert' => $request->insert,
            'update' => $request->update,
        ]);

        return new GudangResource(true, 'Data Supplier Berhasil Ditambahkan!', $supplier);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //find Admin by ID
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json([
                'success' => false,
                'message' => 'Data Supplier Tidak Ditemukan!',
            ], 404);
        }

        //return single admin as a resource
        return new GudangResource(true, 'Detail Data Admin!', $supplier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json(['message' => 'Admin not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_supplier' => 'required',
            'nik_supplier' => 'required',
            'no_hp_supplier' => 'required',
            'insert' => '',
            'update' => '',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $supplier->update([
            'nama_supplier' => $request->nama_supplier,
            'nik_supplier' => $request->nik_supplier,
            'no_hp_supplier' => $request->no_hp_supplier,
            'insert' => $request->insert,
            'update' => $request->update,
        ]);

        return new GudangResource(true, 'Data Supplier Berhasil Diubah!', $supplier);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        $supplier->delete();

        return new GudangResource(true, 'Data Supplier Berhasil Dihapus!', $supplier);
    }
}
