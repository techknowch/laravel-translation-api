<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //
    protected $table = 'languages';
    protected $fillable = ['name', 'code'];
    protected $casts = [
        'name' => 'string',
        'code' => 'string',
    ];
    public $timestamps = true;
    protected $primaryKey = 'id';
}
