<?php

use App\Models\Order;
use App\Models\Service;
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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            
            // Foreign key to services
            $table->foreignIdFor(Order::class);
            // Foreign key to services
            $table->foreignIdFor(Service::class);

            $table->decimal('unit_price', 9, 2);
            $table->decimal('quantity', 9, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
