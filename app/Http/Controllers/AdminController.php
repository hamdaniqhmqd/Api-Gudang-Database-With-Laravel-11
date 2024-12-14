<?php

namespace App\Http\Controllers;

use App\Http\Resources\GudangResource;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::get();

        return new GudangResource(true, 'List Data Admin', $admin);
    }

    public function show($id)
    {
        //find Admin by ID
        $admin = Admin::find($id);

        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Data admin Tidak Ditemukan!',
            ], 404);
        }

        //return single admin as a resource
        return new GudangResource(true, 'Detail Data Admin!', $admin);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'adminName' => 'required',
            'profileImagePath' => 'nullable|image',
            'insert' => '',
            'update' => '',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('profileImagePath');
        $imageName = Str::slug($request->input('username')) . '-' . time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('admin', $imageName, 'public'); // Store in 'storage/app/public/admin'

        $admin = Admin::create([
            'username' => $request->username,
            'password' => $request->password,
            'adminName' => $request->adminName,
            'profileImagePath' => $imageName,
            'insert' => $request->insert,
            'update' => $request->update,
        ]);

        return new GudangResource(true, 'Data Admin Berhasil Ditambahkan!', $admin);
    }

    /*************  ✨ Codeium Command ⭐  *************/
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /******  73cc413a-b949-49a3-a355-42d404db7c09  *******/
    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return response()->json(['message' => 'Admin not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'username' => 'nullable',
            'password' => 'nullable',
            'adminName' => 'nullable',
            'profileImagePath' => 'nullable|image',
            'insert' => '',
            'update' => '',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Process update
        if ($request->hasFile('profileImagePath')) {
            // Delete old image if exists
            if ($admin->profileImagePath) {
                Storage::disk('public')->delete($admin->profileImagePath);
            }

            $image = $request->file('profileImagePath');
            $imageName = Str::slug($request->input('username')) . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('admin', $imageName, 'public'); // Store in 'storage/app/public/admin'

            // Update admin with new image
            $admin->update([
                'username' => $request->username,
                'password' => $request->password,
                'adminName' => $request->adminName,
                'profileImagePath' => $imageName,
                'insert' => $request->insert,
                'update' => $request->update,
            ]);
        } else {
            $admin->update([
                'username' => $request->username,
                'password' => $request->password,
                'adminName' => $request->adminName,
                'insert' => $request->insert,
                'update' => $request->update,

            ]);
        }

        return new GudangResource(true, 'Data Admin Berhasil Diubah!', $admin);
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return response()->json(['message' => 'Admin not found'], 404);
        }

        // Hapus file gambar jika ada
        if ($admin->profileImagePath) {
            Storage::disk('public')->delete($admin->profileImagePath);
        }

        // Hapus data admin
        $admin->delete();

        return new GudangResource(true, 'Data Admin Berhasil Dihapus!', $admin);
    }

    public function login(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cari user berdasarkan username
        $user = Admin::where('username', $validated['username'])->first();

        // Cek apakah user ditemukan dan password cocok
        if ($user && $validated['password'] == $user->password) {
            // Jika berhasil login, return data user (misalnya adminName dan profileImagePath)
            return new GudangResource(true, 'Data Admin Berhasil login!', $user);
        } else {
            // Jika login gagal
            return response()->json([
                'success' => false,
                'message' => 'Data admin gagal Login!',
            ], 404);
        }
    }
}