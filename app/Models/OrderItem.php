<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'service_id',
        'unit_price',
        'quantity',
    ];

    // Define una relación pertenece a (belongsTo) con el modelo 'Service'.
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
