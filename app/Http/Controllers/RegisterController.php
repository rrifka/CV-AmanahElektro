<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\adminModel;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $admin = adminModel::create([
            'admin_username' => $request->admin_username,
            'admin_password' => Hash::make($request->password),
        ]);

        $token = auth()->guard('admin-api')->user();

        return response()->json([
            'status' => 201,
            'message' => 'Berhasil Menambahkan Admin!',
            'data' => $admin,
        ], 201);
    }
}
