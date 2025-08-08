<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $fillable = [
        'datas_id',
        'user_id',
        'conteudo',
        'numero'
    ];

        public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

        public function datas()
    {
        return $this->belongsTo(Datas::class, 'datas_id');
    }

}

