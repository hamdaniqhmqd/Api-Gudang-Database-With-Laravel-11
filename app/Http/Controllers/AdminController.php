<?php

namespace App\Http\Controllers;

use App\Http\Resources\GudangResource;
use App\Models\Admin;
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
            'username' => '',
            'password' => '',
            'adminName' => '',
            'profileImagePath' => '',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $adminData = [
            'username' => $request->username,
            'password' => $request->password,
            'adminName' => $request->adminName,
        ];

        if ($request->hasFile('profileImagePath')) {
            $file = $request->file('profileImagePath');
            $path = $file->store('profile-images', 'public');
            $adminData['profileImagePath'] = $path;
        }

        $admin = Admin::create($adminData);

        return new GudangResource(true, 'Data Admin Berhasil Ditambahkan!', $admin);
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return response()->json(['message' => 'Admin not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'username' => '',
            'password' => '',
            'adminName' => '',
            'profileImagePath' => '',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $adminData = [
            'username' => $request->username ?? $admin->username,
            'password' => $request->password ? $request->password : $admin->password,
            'adminName' => $request->adminName ?? $admin->adminName,
        ];

        if ($request->hasFile('profileImagePath')) {
            // Hapus file gambar lama jika ada
            if ($admin->profileImagePath) {
                Storage::disk('public')->delete($admin->profileImagePath);
            }

            $file = $request->file('profileImagePath');
            $path = $file->store('profile-images', 'public');
            $adminData['profileImagePath'] = $path;
        }

        $admin->update($adminData);

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
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari user berdasarkan username
        $user = Admin::where('username', $validated['username'])->first();

        // Cek apakah user ditemukan dan password cocok
        if ($user && $validated['password'] == $user->password) {
            // Jika berhasil login, return data user (misalnya adminName dan profileImagePath)
            return response()->json([
                'message' => 'Login successful',
                'adminName' => $user->adminName,
                'profileImagePath' => $user->profileImagePath,
            ]);
        }


        // Jika login gagal
        return response()->json([
            'message' => 'Invalid username or password',
        ], 401);
    }
}