<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penyewaandetailModel;
use Illuminate\Support\Facades\Validator;

class penyewaandetailController extends Controller
{
    protected $penyewaandetailModel;

    public function __construct()
    {
        $this->penyewaandetailModel = new penyewaandetailModel();
    }

    public function index()
    {
        try {
            $penyewaandetail = $this->penyewaandetailModel->get();

            if ($penyewaandetail->isEmpty()) {
                return response()->json([
                    'message' => 'Data penyewaan detail masih kosong!',
                    'data' => $penyewaandetail
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Data penyewaan detail berhasil didapatkan',
                    'data' => $penyewaandetail
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
            'penyewaan_detail_penyewaan_id' => 'required|exists:penyewaan,penyewaan_id',
            'penyewaan_detail_alat_id' => 'required|exists:alat,alat_id',
            'penyewaan_detail_jumlah' => 'required|integer',
            'penyewaan_detail_subharga' => 'required|integer'
             
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $penyewaandetail = $this->penyewaandetailModel->create($validator->validated());

        return response()->json([
            'message' => 'Data penyewaan detail berhasil dibuat',
            'data' => $penyewaandetail
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'penyewaan_detail_penyewaan_id' => 'required|exists:penyewaan,penyewaan_id',
            'penyewaan_detail_alat_id' => 'required|exists:alat,alat_id',
            'penyewaan_detail_jumlah' => 'required|integer',
            'penyewaan_detail_subharga' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $penyewaandetail = $this->penyewaandetailModel->find($id);

        if (!$penyewaandetail) {
            return response()->json([
                'message' => 'Data penyewaan detail tidak ditemukan'
            ], 404);
        }

        $penyewaandetail->update($validator->validated());

        return response()->json([
            'message' => 'Data penyewaan detail berhasil diperbarui',
            'data' => $penyewaandetail
        ], 200);
    }

    public function destroy($id)
    {
        $penyewaandetail = $this->penyewaandetailModel->find($id);

        if (!$penyewaandetail) {
            return response()->json([
                'message' => 'Data penyewaan detail tidak ditemukan'
            ], 404);
        }

        $penyewaandetail->delete();

        return response()->json([
            'message' => 'Data penyewaan detail berhasil dihapus'
        ], 200);
    }

    public function show($id)
    {
        $penyewaandetail = $this->penyewaandetailModel->find($id);

        if (!$penyewaandetail) {
            return response()->json([
                'message' => 'Data penyewaan detail tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Data penyewaan detail berhasil didapatkan',
            'data' => $penyewaandetail
        ], 200);
    }
}
