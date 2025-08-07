<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    //
    protected $table = 'translations';
    protected $fillable = ['key', 'content', 'original_content', 'from_locale', 'to_locale', 'language_id', 'tags'];
    protected $casts = [
        'key' => 'string',
        'content' => 'string',
        'language_id' => 'integer',
        'tags' => 'array',
    ];
    public $timestamps = true;
    protected $primaryKey = 'id';
    
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
