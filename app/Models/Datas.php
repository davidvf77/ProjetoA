<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datas extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'data_inicio',
        'data_conclusao'
    ];

        public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

      public function metas()
    {
        return $this->hasMany(Meta::class, 'datas_id');
    }
}
