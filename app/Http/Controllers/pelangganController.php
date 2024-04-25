<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pelangganModel;
use Illuminate\Support\Facades\Validator;

class pelangganController extends Controller
{
    protected $pelangganModel;

    public function __construct()
    {
        $this->pelangganModel = new pelangganModel();
    }

    public function index()
    {
        try {
            $pelanggan = $this->pelangganModel->get();

            if ($pelanggan->isEmpty()) {
                return response()->json([
                    'message' => 'Data pelanggan masih kosong!',
                    'data' => $pelanggan
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Data pelanggan berhasil didapatkan',
                    'data' => $pelanggan
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
            'pelanggan_nama' => 'required|string|max:150',
            'pelanggan_alamat' => 'required|string|max:200',
            'pelanggan_notelp' => 'required|string|max:13',
            'pelanggan_email' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $pelanggan = $this->pelangganModel->create($validator->validated());

        return response()->json([
            'message' => 'Data pelanggan berhasil dibuat',
            'data' => $pelanggan
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pelanggan_nama' => 'required|string|max:150',
            'pelanggan_alamat' => 'required|string|max:200',
            'pelanggan_notelp' => 'required|string|max:13',
            'pelanggan_email' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $pelanggan = $this->pelangganModel->find($id);

        if (!$pelanggan) {
            return response()->json([
                'message' => 'Data pelanggan tidak ditemukan'
            ], 404);
        }

        $pelanggan->update($validator->validated());

        return response()->json([
            'message' => 'Data pelanggan berhasil diperbarui',
            'data' => $pelanggan
        ], 200);
    }

    public function destroy($id)
    {
        $pelanggan = $this->pelangganModel->find($id);

        if (!$pelanggan) {
            return response()->json([
                'message' => 'Data pelanggan tidak ditemukan'
            ], 404);
        }

        $pelanggan->delete();

        return response()->json([
            'message' => 'Data pelanggan berhasil dihapus'
        ], 200);
    }

    public function show($id)
    {
        $pelanggan = $this->pelangganModel->find($id);

        if (!$pelanggan) {
            return response()->json([
                'message' => 'Data pelanggan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Data pelanggan berhasil didapatkan',
            'data' => $pelanggan
        ], 200);
    }
}
