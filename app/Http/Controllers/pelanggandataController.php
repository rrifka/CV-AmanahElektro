<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pelanggandataModel;
use Illuminate\Support\Facades\Validator;

class pelanggandataController extends Controller
{
    protected $pelanggandataModel;

    public function __construct()
    {
        $this->pelanggandataModel = new pelanggandataModel();
    }

    public function index()
    {
        try {
            $pelanggandata = $this->pelanggandataModel->get();

            if ($pelanggandata->isEmpty()) {
                return response()->json([
                    'message' => 'Data pelanggan data masih kosong!',
                    'data' => $pelanggandata
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Data pelanggan data berhasil didapatkan',
                    'data' => $pelanggandata
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
            'pelanggan_data_pelanggan_id' => 'required|exists:pelanggan,pelanggan_id',
            'pelanggan_data_jenis' => 'required|in:KTP,SIM', 
            'pelanggan_data_file' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $pelanggandata = $this->pelanggandataModel->create($validator->validated());

        return response()->json([
            'message' => 'Data pelanggan data berhasil dibuat',
            'data' => $pelanggandata
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pelanggan_data_jenis' => 'required|in:KTP,SIM', 
            'pelanggan_data_file' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $pelanggandata = $this->pelanggandataModel->find($id);

        if (!$pelanggandata) {
            return response()->json([
                'message' => 'Data pelanggan data tidak ditemukan'
            ], 404);
        }

        $pelanggandata->update($validator->validated());

        return response()->json([
            'message' => 'Data pelanggan data berhasil diperbarui',
            'data' => $pelanggandata
        ], 200);
    }

    public function destroy($id)
    {
        $pelanggandata = $this->pelanggandataModel->find($id);

        if (!$pelanggandata) {
            return response()->json([
                'message' => 'Data pelanggan data tidak ditemukan'
            ], 404);
        }

        $pelanggandata->delete();

        return response()->json([
            'message' => 'Data pelanggan data berhasil dihapus'
        ], 200);
    }

    public function show($id)
    {
        $pelanggandata = $this->pelanggandataModel->find($id);

        if (!$pelanggandata) {
            return response()->json([
                'message' => 'Data pelanggan data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Data pelanggan data berhasil didapatkan',
            'data' => $pelanggandata
        ], 200);
    }
}
