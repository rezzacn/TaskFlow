<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'client_id',
        'nama_project',
        'deskripsi',
        'harga',
        'pembayaran_tipe',
        'status',
        'tgl_mulai',
        'deadline',
        'bukti_tf',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
