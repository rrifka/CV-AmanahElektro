<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penyewaanModel;
use Illuminate\Support\Facades\Validator;

class penyewaanController extends Controller
{
    protected $penyewaanModel;

    public function __construct()
    {
        $this->penyewaanModel = new penyewaanModel();
    }

    public function index()
    {
        try {
            $penyewaan = $this->penyewaanModel->get();

            if ($penyewaan->isEmpty()) {
                return response()->json([
                    'message' => 'Data penyewaan masih kosong!',
                    'data' => $penyewaan
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Data penyewaan berhasil didapatkan',
                    'data' => $penyewaan
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
            'penyewaan_pelanggan_id' => 'required|exists:pelanggan,pelanggan_id',
            'penyewaan_tglsewa' => 'required|date', 
            'penyewaan_tglkembali' => 'required|date',
            'penyewaan_sttspembayaran' => 'required|in:Lunas,Belum Dibayar,DP',
            'penyewaan_sttskembali' => 'required|in:Sudah Kembali,Belum Kembali',
            'penyewaan_totalharga' => 'required|integer' 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $penyewaan = $this->penyewaanModel->create($validator->validated());

        return response()->json([
            'message' => 'Data penyewaan berhasil dibuat',
            'data' => $penyewaan
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'penyewaan_pelanggan_id' => 'required|exists:pelanggan,pelanggan_id',
            'penyewaan_tglsewa' => 'required|date', 
            'penyewaan_tglkembali' => 'required|date',
            'penyewaan_sttspembayaran' => 'required|in:Lunas, Belum Dibayar,DP',
            'penyewaan_sttskembali' => 'required|in:Sudah Kembali,Belum Dibayar',
            'penyewaan_totalharga' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $penyewaan = $this->penyewaanModel->find($id);

        if (!$penyewaan) {
            return response()->json([
                'message' => 'Data penyewaan tidak ditemukan'
            ], 404);
        }

        $penyewaan->update($validator->validated());

        return response()->json([
            'message' => 'Data penyewaan berhasil diperbarui',
            'data' => $penyewaan
        ], 200);
    }

    public function destroy($id)
    {
        $penyewaan = $this->penyewaanModel->find($id);

        if (!$penyewaan) {
            return response()->json([
                'message' => 'Data penyewaan tidak ditemukan'
            ], 404);
        }

        $penyewaan->delete();

        return response()->json([
            'message' => 'Data penyewaan berhasil dihapus'
        ], 200);
    }

    public function show($id)
    {
        $penyewaan = $this->penyewaanModel->find($id);

        if (!$penyewaan) {
            return response()->json([
                'message' => 'Data penyewaan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Data penyewaan berhasil didapatkan',
            'data' => $penyewaan
        ], 200);
    }
}
