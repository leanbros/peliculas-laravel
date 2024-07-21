<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'image', 'posted', 'category_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'category_id');
    }
}
