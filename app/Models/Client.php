<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'alamat',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
