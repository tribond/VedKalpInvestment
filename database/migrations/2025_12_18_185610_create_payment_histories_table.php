<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('transaction_id')->unique();
            $table->decimal('amount', 10, 2);
            $table->enum('payment_status', [
                'pending',
                'success',
                'failed',
                'refunded'
            ])->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('service_id')->nullable();
            $table->string('receipt_number')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_histories');
    }
};
