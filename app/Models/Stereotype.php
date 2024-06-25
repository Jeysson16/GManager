<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stereotype extends Model
{
    use HasFactory;    
    protected $fillable = ['category_id','title', 'description', 'price'];

    // Define una relación uno a muchos con la tabla 'categorias'.
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
