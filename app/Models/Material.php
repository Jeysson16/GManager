<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'customer_id', 'description', 'color', 'unit_of_measure', 'stock'];
    
    // Define una relación pertenece a (belongsTo) con el modelo 'Cliente'.
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    // Define una relación uno a muchos (hasMany) con el modelo 'Servicio'.
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
