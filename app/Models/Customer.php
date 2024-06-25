<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
    ];
    
    // Define una relación uno a muchos con la tabla 'pedidos'.
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    // Define una relación uno a muchos con la tabla 'materiales'.
    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }

    // Define una relación uno a muchos con la tabla 'servicios'.
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    // Define una relación uno a muchos con la tabla 'montos'.
    public function montos(): HasMany
    {
        return $this->hasMany(Amount::class);
    }
}