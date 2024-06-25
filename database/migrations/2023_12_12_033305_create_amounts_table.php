<?php

use App\Models\Customer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('amounts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class);
            $table->decimal('amount_to_pay', 9, 2);
            $table->decimal('amount_paid', 9, 2)->nullable();
            $table->decimal('debt_amount', 9, 2)->nullable();
            $table->boolean('is_paid_in_full')->default(false);
            $table->date('fecha_pago');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amounts');
    }
};
