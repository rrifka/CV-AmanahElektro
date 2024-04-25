<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategoriModel;
use Illuminate\Support\Facades\Validator;

class kategoriController extends Controller
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new kategoriModel();
    }

    public function index()
    {
        try {
            $kategori = $this->kategoriModel->get();

            if ($kategori->isEmpty()) {
                return response()->json([
                    'message' => 'Data kategori masih kosong!',
                    'data' => $kategori
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Data kategori berhasil didapatkan',
                    'data' => $kategori
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
            'kategori_nama' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $kategori = $this->kategoriModel->create($validator->validated());

        return response()->json([
            'message' => 'Data kategori berhasil dibuat',
            'data' => $kategori
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kategori_nama' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $kategori = $this->kategoriModel->find($id);

        if (!$kategori) {
            return response()->json([
                'message' => 'Data kategori tidak ditemukan'
            ], 404);
        }

        $kategori->update($validator->validated());

        return response()->json([
            'message' => 'Data kategori berhasil diperbarui',
            'data' => $kategori
        ], 200);
    }

    public function destroy($id)
    {
        $kategori = $this->kategoriModel->find($id);

        if (!$kategori) {
            return response()->json([
                'message' => 'Data kategori tidak ditemukan'
            ], 404);
        }

        $kategori->delete();

        return response()->json([
            'message' => 'Data kategori berhasil dihapus'
        ], 200);
    }

    public function show($id)
    {
        $kategori = $this->kategoriModel->find($id);

        if (!$kategori) {
            return response()->json([
                'message' => 'Data kategori tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Data kategori berhasil didapatkan',
            'data' => $kategori
        ], 200);
    }
}
