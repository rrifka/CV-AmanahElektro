<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penyewaandetailModel extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'penyewaan_detail';
    protected $primaryKey = 'penyewaan_detail_id';
    protected $fillable = [
        'penyewaan_detail_penyewaan_id',
            'penyewaan_detail_alat_id',
            'penyewaan_detail_jumlah',
            'penyewaan_detail_subharga',
    ];
    public function get_penyewaan()
    {
        return self::all();
    }

    public function penyewaan()
    {
        return $this->belongsTo(penyewaanModel::class, 'penyewaan_detail_penyewaan_id', 'penyewaan_id');
    }

    public function alat()
    {
        return $this->belongsTo(alatModel::class, 'penyewaan_detail_alat_id', 'alat_id');
    }


    public function create_penyewaandetail($data)
    {
        return self::create($data);
    }

    public function update_penyewaandetail($data, $id)
    {
        $penyewaandetail = self::find($id);
        $penyewaandetail->fill($data);
        $penyewaandetail->update();
        return $penyewaandetail;
    }

    public function delete_penyewaandetail($id)
    {
        $penyewaandetail = self::find($id);
        self::destroy($id);
        return $penyewaandetail;
    }
}
