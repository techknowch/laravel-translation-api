<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Translation extends Model
{
    //
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
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
