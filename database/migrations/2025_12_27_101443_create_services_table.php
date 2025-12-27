<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id(); 
            $table->string('title', 100);
            $table->string('subscription_type', 100);
            $table->text('description')->nullable();
            $table->decimal('subscription_amount', 10, 2);
            $table->enum('subscription_duration', ['monthly', 'yearly']);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};

