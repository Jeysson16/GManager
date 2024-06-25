<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'description'];
    
    // Define una relación uno a muchos con la tabla 'servicios'.
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
    
    //Define una relación pertenece a (belongsTo) con el modelo 'estereotipo'.
    public function stereotypes(): HasMany
    {
        return $this->hasMany(Stereotype::class);
    }
}
