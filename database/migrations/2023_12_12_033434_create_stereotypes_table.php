<?php

use App\Models\Category;
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
        Schema::create('stereotypes', function (Blueprint $table) {
            $table->id();            
            $table->foreignIdFor(Category::class);
            $table->string('title');
            $table->text('description');
            $table->decimal('price',7,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stereotypes');
    }
};
