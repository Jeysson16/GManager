<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'description', 'category_id', 'customer_id', 'material_id', 'material_quantity', 'price', 'is_public', 'folder_location', 'image'];
    
    //Define una relación pertenece a (belongsTo) con el modelo 'Categoria'.
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Define una relación pertenece a (belongsTo) con el modelo 'Cliente'.
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    // Define una relación pertenece a (belongsTo) con el modelo 'Material'.
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
    
    // Define una relación uno a muchos con la tabla 'servicios'.
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
