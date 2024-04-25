<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\adminModel;
use Illuminate\Support\Facades\Validator;

class adminController extends Controller
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new adminModel();
    }

    public function index()
    {
        try {
            $admin = $this->adminModel->get();

            if ($admin->isEmpty()) {
                return response()->json([
                    'message' => 'Data admin masih kosong!',
                    'data' => $admin
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Data admin berhasil didapatkan',
                    'data' => $admin
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan pada server'
            ], 500);
        }
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_username' => 'required|string|max:50',
            'admin_password' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $alat = $this->adminModel->create($validator->validated());

        return response()->json([
            'message' => 'Data admin berhasil dibuat',
            'data' => $alat
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'admin_username' => 'required|string|max:50',
            'admin_password' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $admin = $this->adminModel->find($id);

        if (!$admin) {
            return response()->json([
                'message' => 'Data admin tidak ditemukan'
            ], 404);
        }

        $admin->update($validator->validated());

        return response()->json([
            'message' => 'Data admin berhasil diperbarui',
            'data' => $admin
        ], 200);
    }

    public function destroy($id)
    {
        $admin = $this->adminModel->find($id);

        if (!$admin) {
            return response()->json([
                'message' => 'Data admin tidak ditemukan'
            ], 404);
        }

        $admin->delete();

        return response()->json([
            'message' => 'Data admin berhasil dihapus'
        ], 200);
    }

    public function show($id)
    {
        $admin = $this->adminModel->find($id);

        if (!$admin) {
            return response()->json([
                'message' => 'Data admin tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Data admin berhasil didapatkan',
            'data' => $admin
        ], 200);
    }
}
