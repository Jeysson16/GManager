<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Amount extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'amount_to_pay', 'amount_paid', 'debt_amount', 'is_paid_in_full', 'fecha_pago'];
    
    // Define una relación uno a muchos con la tabla 'clientes'.
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
