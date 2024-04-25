<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penyewaanModel extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'penyewaan';
    protected $primaryKey = 'penyewaan_id';
    protected $fillable = [
        'penyewaan_pelanggan_id',
        'penyewaan_tglsewa',
        'penyewaan_tglkembali',
        'penyewaan_sttspembayaran',
        'penyewaan_sttskembali',
        'penyewaan_totalharga',
    ];
    public function get_penyewaan()
    {
        return self::all();
    }

    public function pelanggan()
    {
        return $this->belongsTo(pelangganModel::class, 'penyewaan_pelanggan_id', 'pelanggan_id');
    }


    public function create_penyewaan($data)
    {
        return self::create($data);
    }

    public function update_penyewaan($data, $id)
    {
        $penyewaan = self::find($id);
        $penyewaan->fill($data);
        $penyewaan->update();
        return $penyewaan;
    }

    public function delete_penyewaan($id)
    {
        $penyewaan = self::find($id);
        self::destroy($id);
        return $penyewaan;
    }
}
