<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelanggandataModel extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'pelanggan_data';
    protected $primaryKey = 'pelanggan_data_id';
    protected $fillable = [
        'pelanggan_data_pelanggan_id',
        'pelanggan_data_jenis',
        'pelanggan_data_file',
    ];
    public function get_pelanggandata()
    {
        return self::all();
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriModel::class, 'pelanggan_data_id', 'pelanggan_id');
    }

    public function create_pelanggandata($data)
    {
        return self::create($data);
    }

    public function update_pelanggandata($data, $id)
    {
        $pelanggandata = self::find($id);
        $pelanggandata->fill($data);
        $pelanggandata->update();
        return $pelanggandata;
    }

    public function delete_pelanggandata($id)
    {
        $pelanggandata = self::find($id);
        self::destroy($id);
        return $pelanggandata;
    }
}
