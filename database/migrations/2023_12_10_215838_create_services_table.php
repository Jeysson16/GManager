<?php

use App\Models\Category;
use App\Models\Customer;
use App\Models\Material;
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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title', 40)->unique();
            $table->string('slug', 40)->unique();
            $table->text('description')->nullable();

            // Foreign key to Categories
            $table->foreignIdFor(Category::class);

            // Foreign key to Clients
            $table->foreignIdFor(Customer::class);
            
            // Foreign key to Materials
            $table->foreignIdFor(Material::class);

            $table->decimal('material_quantity', 9, 2)->unsigned()->default(0.00);
            $table->decimal('price', 9, 2)->unsigned()->default(0.00);
            $table->boolean('is_public')->default(true);
            
            $table->string('folder_location', 255)->nullable();
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
